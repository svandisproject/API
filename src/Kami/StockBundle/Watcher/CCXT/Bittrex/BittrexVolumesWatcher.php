<?php


namespace Kami\StockBundle\Watcher\CCXT\Bittrex;

use ccxt\ExchangeError;
use ccxt\NetworkError;
use Exception;
use Kami\StockBundle\Watcher\AbstractVolumesWatcher;
use \ccxt\bittrex;

class BittrexVolumesWatcher extends AbstractVolumesWatcher
{

    public function updateVolumes()
    {
        $bittrexExchange = new bittrex();

        try {
            $bittrexTickers = $bittrexExchange->fetch_tickers();

        } catch (NetworkError $e) {
            $this->logger->error( '[Network Error] Could\'t update bittrex volumes' . $e->getMessage ());
        } catch (ExchangeError $e) {
            $this->logger->error( '[Exchange Error] Could\'t update bittrex volumes' . $e->getMessage ());
        } catch (Exception $e) {
            $this->logger->error( '[Error] Could\'t update bittrex volumes' . $e->getMessage ());
        }

        $assetsValues = $this->getUsdValues($bittrexTickers);
        foreach ($assetsValues as $assetKey => $usdVolume) {
            $asset = $this->findAsset($assetKey);
            $this->persistVolumes($asset, $usdVolume, 'Bittrex');
        }
    }

    private function getUsdValues($markets)
    {
        $valuesArray = [];

        $BTC = $markets['BTC/USD']['last'];
        $ETH = $markets['ETH/USD']['last'];
        $USDT = $markets['USDT/USD']['last'];
        $USD = $markets['TUSD/USD']['last'];


        foreach ($markets as $pair => $data) {
                $assetsArr = explode('/', $pair);
                $currency = $assetsArr[1];
                $asset = $assetsArr[0];
                $valuesArray[$asset] = isset($valuesArray[$asset]) ? $valuesArray[$asset] : 0;
                $valuesArray[$asset] += ($currency == "USD") ? $data['info']['BaseVolume'] : ($data['info']['BaseVolume'] * $$currency);

        }
        return $valuesArray;
    }

}