<?php


namespace Kami\StockBundle\Watcher\Bittrex\Utils;

use GuzzleHttp\Client;

class BittrexClient implements ClientInterface
{

    private $guzzle;

    public function __construct()
    {
        $this->guzzle = new Client();
    }

    private function query($options)
    {
        $promise = $this->guzzle->getAsync(self::API_URL . $options);
        return json_decode($promise->wait()->getBody());
    }

    /**
     * Get  tickers list from markets
     *
     * @return array
     */
    public function getTickers() :array
    {
        $tickersArray = [];

        foreach ($this->getMarketsSummaries() as $pair => $value) {
            $tickersArray[$pair] = $value['Last'];
        }

       return $tickersArray;
    }

    public function getMarketsSummaries()
    {
        $marketsSummariesArray = [];
        $dataArray = $this->query('getmarketsummaries');
        foreach ($dataArray->result as $market) {
            $marketsSummariesArray[$market->MarketName] =
                [
                    'Last' => $market->Last,
                    'Volume' => $market->Volume,
                    'BaseVolume' => $market->BaseVolume,
                    'TimeStamp' => $market->TimeStamp
                ];
        }
        return $marketsSummariesArray;
    }

}