<?php


namespace Kami\StockBundle\Watcher\Bittrex;

use Kami\StockBundle\Watcher\AbstractVolumesWatcher;

class BittrexVolumeWatcher extends AbstractVolumesWatcher
{

    public function updateVolumes()
    {
        $markets = $this->bittrexClient->getMarketsSummaries();
        $assetsValues = $this->getUsdValues($markets);

        foreach ($assetsValues as $assetKey => $usdVolume) {
            $asset = $this->findAsset($assetKey);
            $this->persistVolumes($asset, $usdVolume, 'Bittrex');
        }
    }

    private function getUsdValues($markets)
    {
        $valuesArray = [];
        $BTC = $this->bittrexClient->getMarketsSummaries()["USD-BTC"]["Last"];
        $ETH  = $this->bittrexClient->getMarketsSummaries()["USD-ETH"]["Last"];
        $USDT = $this->bittrexClient->getMarketsSummaries()["USD-USDT"]["Last"];
        $USD = $this->bittrexClient->getMarketsSummaries()["USD-TUSD"]["Last"];

        foreach ($markets as $pair => $data) {
            $assetsArr = explode('-', $pair);
            $currency = $assetsArr[0];
            $asset = $assetsArr[1];
            $valuesArray[$asset] = isset($valuesArray[$asset]) ? $valuesArray[$asset] : 0;
            $valuesArray[$asset] += ($currency == "USD") ? $data['BaseVolume'] : ($data['BaseVolume'] * $$currency);
        }
        return $valuesArray;
    }


}