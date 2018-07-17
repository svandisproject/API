<?php


namespace Kami\StockBundle\Watcher\Bittrex\Utils;

use function dump;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use GuzzleHttp\Exception\RequestException;

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

    /*
     * Get markets list from Bittrex API
     *
     */
    public function getMarkets() :array
    {
        $marketsArray = [];
       $dataArray  = $this->query('getmarkets');
        foreach ($dataArray->result as $market) {
            $marketsArray[] = $market->MarketName;
        }
        return $marketsArray;
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