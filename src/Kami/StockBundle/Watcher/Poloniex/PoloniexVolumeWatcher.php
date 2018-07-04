<?php


namespace Kami\StockBundle\Watcher\Poloniex;

use Kami\StockBundle\Watcher\AbstractVolumesWatcher;

class PoloniexVolumeWatcher extends AbstractVolumesWatcher
{

    private $usdPrices = ['BTC' => 0, 'ETH' => 0, 'XMR' => 0, 'USDT' => 0];

    protected $useProxy = true;

    public function updateVolumes()
    {
        $this->updateMainCurrenciesUsdPrice();
        try {
            $body = $this->httpClient->get('https://poloniex.com/public?command=return24hVolume')->getBody();
            $data = (array) json_decode($body);
            $usdValues = $this->getUsdValues($data);

            foreach ($usdValues as $assetKey => $usdVolume) {
                $asset = $this->findAsset($assetKey);
                $this->persistVolumes($asset, $usdVolume, 'Poloniex');
            }
        } catch (\Exception $exception) {
            $this->logger->error('Could\'t update poloniex prices');
        }
    }

    /**
     * @param array $data
     *
     * @return array
     */
    private function getUsdValues($data): array
    {
        $points = [];

        foreach ($data as $pair => $values){
            if(substr($pair, 0, 5) != 'total') {
                foreach ($this->usdPrices as $currency => $currencyUsdPrice) {
                    if (array_search($currency, array_keys((array)$values)) === 0) {
                        $asset = array_keys((array)$values)[1];
                        $points[$asset] = isset($points[$asset]) ? $points[$asset] : 0;
                        $points[$asset] += ($currency == 'USDT') ? $values->USDT : ($values->$currency * $this->usdPrices[$currency]);
                    }
                }
            }
        }

        return $points;
    }

    private function updateMainCurrenciesUsdPrice(){
        try {
            $prices = $this->httpClient->get('https://poloniex.com/public?command=returnTicker')->getBody();
            $data = (array) json_decode($prices);
            foreach ($data as $datum => $ddd){
                foreach ($this->usdPrices as $currency => $price){
                    if($datum == 'USDT_' . $currency){
                        $this->usdPrices[$currency] = $ddd->last;
                    }
                }
            }
        } catch (\Exception $exception) {
            $this->logger->error('Could\'t update poloniex main currencies usd prices');
        }
    }

}