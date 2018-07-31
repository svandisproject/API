<?php

namespace Kami\StockBundle\Watcher\CCXT;

use ccxt\binance;
use ccxt\bittrex;
use ccxt\poloniex;
use function dump;
use const false;
use Kami\StockBundle\Watcher\AbstractExchangeWatcher;

include dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))).'/vendor/ccxt/ccxt/ccxt.php';
//include '../../../../../vendor/ccxt/ccxt/ccxt.php';


class CcxtWatcher extends AbstractExchangeWatcher
{

    public function updateAssetPrices()
    {

        $pol = new poloniex();
        $binanceExchange = new binance(array (
            'verbose' => false,
            'timeout' => 30000,
        ));

        $bittrexExchange = new bittrex();


        try {
//
            $bittrexTickers = $bittrexExchange->fetch_tickers();
            $bittrexTicker = $bittrexExchange->fetch_ticker('ETH/BTC');

            $tickersArray = $this->getUsdPrices($bittrexTickers);

            foreach ($tickersArray as $tickerData) {
                if ($tickerData['asset'] == 'ZEC') {
                    dump($tickerData);
                }

            }

        } catch (\ccxt\NetworkError $e) {
            echo '[Network Error] ' . $e->getMessage () . "\n";
        } catch (\ccxt\ExchangeError $e) {
            echo '[Exchange Error] ' . $e->getMessage () . "\n";
        } catch (Exception $e) {
            echo '[Error] ' . $e->getMessage () . "\n";
        }



//        try {
//
//            $symbol = 'ETH/BTC';
//            $result = $exchange->fetch_tickers ();
//
//            foreach ($result as $data) {
//                dump($data); die;
//            }
//
//        } catch (\ccxt\NetworkError $e) {
//            echo '[Network Error] ' . $e->getMessage () . "\n";
//        } catch (\ccxt\ExchangeError $e) {
//            echo '[Exchange Error] ' . $e->getMessage () . "\n";
//        } catch (Exception $e) {
//            echo '[Error] ' . $e->getMessage () . "\n";
//        }
    }

    public function getUsdPrices(array $tickers)
    {
        $points = [];
        $usdPrices = [];

        foreach ($tickers as $pair => $data) {
                $currenciesArr = explode('/', $pair);

                if ($currenciesArr[1] == "USD") {
                    $usdPrices[$pair] = $data['last'];
                    array_push($points, ['asset' => $currenciesArr[0], 'price' => $data['last']]);

            }
        }

        foreach ($tickers as $pair => $data) {
                $coinsArray = explode('/', $pair);
                $currency = $coinsArray[1];
                $asset = $coinsArray[0];

                if ($currency !== "USD") {
                    $rate = $usdPrices[$currency . '/USD'] * $data['last'];
                    array_push($points, ['asset' => $asset, 'price' => $rate]);
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