<?php


namespace Kami\StockBundle\Watcher\Bittrex\Utils;

use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use GuzzleHttp\Exception\RequestException;

class BittrexClient implements ClientInterface
{


    private $tickersArray = [];

    private $guzzle;

    public function __construct()
    {
        $this->guzzle = new Client();
    }

    private function query($options)
    {

        $response = $this->guzzle->get(self::API_URL . $options);

        return json_decode($response->getBody());

    }

    /**
     * Get  tickers list from markets
     *
     * @return array
     */
    public function getTickers() :array
    {
        $linksArray = [];

        $marketsArray = $this->getMarkets();

        foreach ($marketsArray as $market) {
            $linksArray[$market] = $this->guzzle->getAsync(self::API_URL . 'getticker?market=' . $market);
        }
         Promise\all($linksArray)->then(
            function ( $responses) {
                foreach ($responses as $pair => $response) {

                    $this->tickersArray[$pair]  =  json_decode($response->getBody(), true)['result']['Last'];
                }
            },
            function (RequestException $e) {
                echo $e->getMessage() . "\n";
            }
        )->wait();

       return $this->tickersArray;
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