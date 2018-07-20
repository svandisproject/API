<?php


namespace Kami\StockBundle\Watcher\Binance;

use Binance\API;
use Kami\StockBundle\Watcher\AbstractExchangeWatcher;

class BinanceWatcher extends AbstractExchangeWatcher
{
    /**
     * @var array
     */
    private $convertableTickers = ['USDT', 'BTC', 'ETH', 'BNB'];

    /**
     * @throws \Exception
     * @throws \Cassandra\Exception
     * @return void
     */
    public function updateAssetPrices()
    {
        $api = new API();
        $tickers = $api->prices();
        $tickersArray = $this->getUsdPrices($tickers);
        foreach ($tickersArray as $tickerData) {
            $point = $this->createNewPoint($tickerData);
            $this->persistPoint($point, 'Binance');
        }
    }

    /**
     * @param array $data
     * @return array
     */
    public function getUsdPrices(array $data): array
    {
        $points = [];

        foreach ($data as $pair => $price) {

            foreach ($this->convertableTickers as $currency) {
                if (strpos($pair, $currency) >= 1) {
                    $asset = strstr($pair, $currency, true);

                    if ($currency == 'USDT') {
                        $rate = $price;
                    } else {
                        $rate = $data[$currency.'USDT'] * $price;
                    }
                    array_push($points, ['asset' => $asset, 'price' => floatval($rate)]);
                }
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
    private function usdPriceNormalize($tickersArray): array
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