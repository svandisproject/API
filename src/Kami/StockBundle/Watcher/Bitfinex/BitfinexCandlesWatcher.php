<?php


namespace Kami\StockBundle\Watcher\Bitfinex;

use GuzzleHttp\Client;
use Kami\StockBundle\AbstractCandlesWatcher;

class BitfinexCandlesWatcher extends AbstractCandlesWatcher
{
    public function updateAssetCandles()
    {
        $candles = [];
        $guzzle = new Client();
        $body = $guzzle->get('https://api.bitfinex.com/v2/tickers?symbols=ALL')->getBody();
        $apiData = json_decode($body);
        //TODO finish method
        foreach ($apiData as $data) {
            dump($data); die;
            $requestBody = $guzzle->get('https://api.bitfinex.com/v2/candles/trade:1m:'.$data[0].'/last?limit=')->getBody();
            $candle = json_decode($requestBody);
            $candles[$candle[0]][] = $candle;
            dump($data[0]);
            sleep(3);
        }
        dump($candles); die;
    }
}