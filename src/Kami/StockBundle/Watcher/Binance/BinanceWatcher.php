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

        $ticker = $api->prices();

        $tickersArray = $this->getUsdPrices($ticker);
        foreach ($tickersArray as $tickerData) {
            $point = $this->createNewPoint($tickerData);

            $this->persistPoint($point);
        }
    }

    /**
     * @param array $data
     * @return array
     */
    public function getUsdPrices(array $data) :array
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
        return $points;
    }

}