<?php


namespace Kami\StockBundle\Watcher\CCXT\Bittrex;

use ccxt\bittrex;
use ccxt\ExchangeError;
use ccxt\NetworkError;
use Kami\StockBundle\Watcher\AbstractExchangeWatcher;

include_once dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))))).'/vendor/ccxt/ccxt/ccxt.php';

class BittrexAssetsWatcher extends AbstractExchangeWatcher
{

    public function updateAssetPrices()
    {

        $bittrexExchange = new bittrex();

        try {
            $bittrexTickers = $bittrexExchange->fetch_tickers();

        } catch (NetworkError $e) {
            $this->logger->error('[Network Error] ' . $e->getMessage ());
        } catch (ExchangeError $e) {
            $this->logger->error('[Exchange Error] ' . $e->getMessage ());
        } catch (\Exception $e) {
            $this->logger->error('[Error] ' . $e->getMessage ());
        }

        if ($bittrexTickers) {
            $tickersArray = $this->getUsdPrices($bittrexTickers);

            foreach ($tickersArray as $tickerData) {
                $point = $this->createNewPoint($tickerData);
                $this->persistPoint($point, 'Bittrex');
            }
        }

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