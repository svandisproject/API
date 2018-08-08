<?php


namespace Kami\StockBundle\Watcher\Bittrex\Utils;

use GuzzleHttp\Client;

class BittrexClient implements ClientInterface
{

    private function query($options)
    {
        $guzzle = new Client();
        try {
            $body = $guzzle->get(self::API_URL . $options)->getBody();
            $data = json_decode($body);
            return $data;

        } catch (\Exception $exception) {
            dump($exception->getMessage());
        }

    }

    /**
     * Get  tickers list from markets
     *
     * @return array
     */
    public function getTickers() :array
    {

        $tickersArray = [];

        $marketsArray = $this->getMarkets();

        foreach ($marketsArray as $market) {

            $data = $this->getTicker($market);
            array_push($tickersArray, [$market => $data->result->Last]);
        }

       return $tickersArray;
    }

    /**
     * Get one ticker data
     * @param string $market
     *
     * @return array
     */
    public function getTicker($market)
    {
        return $this->query('getticker?market=' . $market);
    }

    /**
     * Get markets list from Bittrex API
     *
     */
    public function getMarkets() :array
    {
        $marketsArray = [];
        $dataArray = $this->query('getmarkets');
        foreach ($dataArray->result as $market) {
            array_push($marketsArray, $market->MarketName);
        }

        return $marketsArray;
    }

    public function getMarketsSummaries()
    {
        $marketsSummariesArray = [];
        $dataArray = $this->query('getmarketsummaries');
        foreach ($dataArray->result as $market) {
            array_push($marketsSummariesArray, [
                $market->MarketName => [
                    'Volume' => $market->Volume,
                    'BaseVolume' => $market->BaseVolume,
                    'TimeStamp' => $market->TimeStamp
                ]
            ]);
        }
        return $marketsSummariesArray;
    }

}