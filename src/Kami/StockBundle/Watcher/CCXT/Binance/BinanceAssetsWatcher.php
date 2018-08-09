<?php

namespace Kami\StockBundle\Watcher\CCXT\Binance;

use ccxt\binance;
use Kami\StockBundle\Watcher\AbstractExchangeWatcher;
use ccxt\ExchangeError;
use ccxt\NetworkError;

class BinanceAssetsWatcher extends AbstractExchangeWatcher
{

    public function updateAssetPrices()
    {
        $binanceExchange = new binance();

        try {
            $binanceTickers = $binanceExchange->fetch_tickers();

        } catch (NetworkError $e) {
            $this->logger->error('[Network Error] ' . $e->getMessage ());
        } catch (ExchangeError $e) {
            $this->logger->error('[Exchange Error] ' . $e->getMessage ());
        } catch (\Exception $e) {
            $this->logger->error('[Error] ' . $e->getMessage ());
        }

        if ($binanceTickers) {
            $tickersArray = $this->getUsdPrices($binanceTickers);
            foreach ($tickersArray as $tickerData) {
                $point = $this->createNewPoint($tickerData);
                $this->persistPoint($point, 'Binance');
            }
        }
    }

    public function getUsdPrices(array $binanceTickers)
    {
        $points = [];

        foreach ($binanceTickers as $pair => $tickerData) {

            $tickerArray = explode('/', $pair);

            $asset = $tickerArray[0];
            $currency = $tickerArray[1];
                    if ($currency == 'USDT') {
                        $rate = $tickerData['last'];
                    } else {
                        $rate = $binanceTickers[$currency.'/USDT']['last'] * $tickerData['last'];
                    }
                    array_push($points, ['asset' => $asset, 'price' => $rate]);

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