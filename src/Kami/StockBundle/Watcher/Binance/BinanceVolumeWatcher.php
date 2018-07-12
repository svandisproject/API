<?php


namespace Kami\StockBundle\Watcher\Binance;

use Binance\API;
use Kami\StockBundle\Watcher\AbstractVolumesWatcher;

class BinanceVolumeWatcher extends AbstractVolumesWatcher
{
    private $convertableTickersVolume = ['USDT', 'BTC', 'ETH', 'BNB'];

    public function updateVolumes()
    {
        $binanceApi = new API();
        $ticker = $binanceApi->prices();
        $volume = $binanceApi->prevDay();
        $usdValues = $this->getUsdValues($volume, $ticker);

        foreach ($usdValues as $assetKey => $usdVolume) {
            $asset = $this->findAsset($assetKey);
            $this->persistVolumes($asset, $usdVolume, 'Binance');
        }
    }

    /**
     * @param array $volume
     * @param array $ticker
     *
     * @return array
     */
    private function getUsdValues($volume, $ticker): array
    {
        $points = [];

        foreach ($volume as $data) {
            foreach ($this->convertableTickersVolume as $currency) {
                if (strpos($data['symbol'], $currency) >= 1) {
                    $asset = strstr($data['symbol'], $currency, true);
                    $points[$asset] = isset($points[$asset]) ? $points[$asset] : 0;
                    $points[$asset] += ($currency == 'USDT') ? $data['quoteVolume'] : ($data['quoteVolume'] * $ticker[$currency.'USDT']);
                }
            }
        }

        return $points;

    }

}