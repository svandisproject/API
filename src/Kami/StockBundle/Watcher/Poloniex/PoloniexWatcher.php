<?php


namespace Kami\StockBundle\Watcher\Poloniex;

use GuzzleHttp\Client;
use Kami\StockBundle\Watcher\AbstractExchangeWatcher;

class PoloniexWatcher extends AbstractExchangeWatcher
{

    protected $useProxy = true;

    /**
     * @throws \Exception
     * @throws \Cassandra\Exception
     * @return void
     */
    public function updateAssetPrices()
    {
        try {
            $body = $this->httpClient->get('https://poloniex.com/public?command=returnTicker')->getBody();
            $data = (array) json_decode($body);
            $tickersArray = $this->getUsdPrices($data);
            foreach ($tickersArray as $tickerData) {
                $point = $this->createNewPoint($tickerData);

                $this->persistPoint($point);
            }
        } catch (\Exception $exception) {
            $this->logger->error('Could\'t update poloniex prices');
        }

    }

    /**
     * @param array $data
     * @return array
     */
    public function getUsdPrices(array $data) :array
    {
        $points = [];
        $usdPrices = [];

        foreach ($data as $pair => $dataObject) {
            $currenciesArr = explode('_', $pair);
            if($currenciesArr[0] == "USDT"){
                $usdPrices[$pair] = floatval($dataObject->last);
                array_push($points, ['asset' => $currenciesArr[1], 'price' => floatval($dataObject->last)]);
            }
        }

        foreach ($data as $pair => $dataObject) {
            $coinsArray = explode('_', $pair);
            $currency = $coinsArray[0];
            $asset = $coinsArray[1];
            if ($currency !== "USDT") {
                $rate = $usdPrices['USDT_' . $currency] * floatval($dataObject->last);
                array_push($points, ['asset' => $asset, 'price' => $rate]);
            }
        }

        $points = $this->usdPriceNormalize($points);
        return $points;
    }

    /**
    * Get average arithmetic of asset price in USD
    *
    * @param array
    *
    * @return array
    */
    private function usdPriceNormalize($tickersArray) :array
    {
        $normalizeArray = [];
        $resultArray = [];
        foreach ($tickersArray as $tickers) {
            if (!key_exists($tickers['asset'], $normalizeArray)) {
                $normalizeArray[$tickers['asset']] = $tickers['price'];
            } else {
                $normalizeArray[$tickers['asset']] = ($normalizeArray[$tickers['asset']] + $tickers['price']) / 2;
            }
        }
        foreach ($normalizeArray as $asset => $price) {
            array_push($resultArray, ['asset' => $asset, 'price' => $price]);
        }

        return $resultArray;
    }



}