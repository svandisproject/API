<?php


namespace Kami\StockBundle\Watcher\CCXT\Binance;

use ccxt\ExchangeError;
use ccxt\NetworkError;
use Exception;
use Kami\StockBundle\Watcher\AbstractVolumesWatcher;
use \ccxt\binance;

class BinanceVolumesWatcher extends AbstractVolumesWatcher
{
    public function updateVolumes()
    {
        $binanceExchange = new binance();

        try {
            $binanceTickers = $binanceExchange->fetch_tickers();

        } catch (NetworkError $e) {
            $this->logger->error( '[Network Error] Could\'t update bittrex volumes' . $e->getMessage ());
        } catch (ExchangeError $e) {
            $this->logger->error( '[Exchange Error] Could\'t update bittrex volumes' . $e->getMessage ());
        } catch (Exception $e) {
            $this->logger->error( '[Error] Could\'t update bittrex volumes' . $e->getMessage ());
        }

        $assetsValues = $this->getUsdValues($binanceTickers);
        foreach ($assetsValues as $assetKey => $usdVolume) {
            $asset = $this->findAsset($assetKey);
            $this->persistVolumes($asset, $usdVolume, 'Bittrex');
        }
    }

    private function getUsdValues($markets)
    {
        $points = [];

        foreach ($markets as $pair => $tickerData) {

            $assetsArray = explode('/', $pair);

            $asset = $assetsArray[0];
            $currency = $assetsArray[1];
                    $points[$asset] = isset($points[$asset]) ? $points[$asset] : 0;
                    $points[$asset] += ($currency == 'USDT') ?
                        $tickerData['info']['quoteVolume'] :
                        ($tickerData['info']['quoteVolume'] * $markets[$currency.'/USDT']['last']);

        }
        return $points;
    }
}