<?php


namespace Kami\StockBundle\Watcher\Bittrex;

use Kami\StockBundle\Watcher\AbstractExchangeWatcher;
use Kami\StockBundle\Watcher\Bittrex\Utils\BittrexClient;

class BittrexWatcher extends AbstractExchangeWatcher
{

    /**
     * @throws \Cassandra\Exception
     * @throws \Doctrine\ORM\ORMException
     */
    public function updateAssetPrices()
    {
        $client = new BittrexClient();

        if (!$tickers = $client->getTickers()) {
            $this->logger->error('Couldn\'t get data from Bittrex API');
        }
        $tickersArray = $this->getUsdPrices($tickers);

        foreach ($tickersArray as $tickerData) {
            $point = $this->createNewPoint($tickerData);

            $this->persistPoint($point, 'Bittrex');
        }
    }

    public function getUsdPrices(array $tickers)
    {
        $points = [];
        $usdPrices = [];

        foreach ($tickers as $ticker) {
            foreach ($ticker as $pair => $price) {
                $currenciesArr = explode('-', $pair);
                if($currenciesArr[0] == "USD"){
                    $usdPrices[$pair] = $price;
                    array_push($points, ['asset' => $currenciesArr[1], 'price' => $price]);
                }
            }
        }
        foreach ($tickers as $ticker) {
            foreach ($ticker as $pair => $price) {

                    $coinsArray = explode('-', $pair);
                    $currency = $coinsArray[0];
                    $asset = $coinsArray[1];

                    if ($currency !== "USD") {
                        $rate = $usdPrices['USD-' . $currency] * $price;
                        array_push($points, ['asset' => $asset, 'price' => $rate]);
                    }
                }
            }

          $pointsArray = $this->usdPriceNormalize($points);
        return $pointsArray;
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