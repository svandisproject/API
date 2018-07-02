<?php


namespace Kami\StockBundle\Watcher\Bittrex;


use Kami\AssetBundle\Entity\Asset;
use Kami\StockBundle\Watcher\AbstractVolumesWatcher;

class BittrexVolumeWatcher extends AbstractVolumesWatcher
{

    public function updateVolumes()
    {
        $markets = $this->bittrexClient->getMarketsSummaries();

        $assetsValues = $this->getUsdValues($markets);

        foreach ($assetsValues as $assetKey => $values) {

            $asset = $this->findAsset($assetKey);

            $this->persistVolumes($asset, $values);
        }

    }

    private function getUsdValues($markets)
    {
        $valuesArray = [];

        foreach ($markets as $market) {

            foreach ($market as $pair => $data ) {

                $assetsArr = explode('-', $pair);

                    if ($assetsArr[0] !== "USD") {

                        $usdValue =  ($this->bittrexClient->getTicker("USD-" . $assetsArr[0]))->result->Last;

                        if (!key_exists($assetsArr[1], $valuesArray)) {
                            $valuesArray[$assetsArr[1]]['volumeUSD'] = $data['BaseVolume'] * $usdValue;
                            $valuesArray[$assetsArr[1]]['time'] = $data['TimeStamp'];
                            echo "First time - " . $assetsArr[1] . " with usdValue " . $data['BaseVolume'] * $usdValue . "\n";
                        } else {
                            $valuesArray[$assetsArr[1]]['volumeUSD'] += $data['BaseVolume'] * $usdValue;
                            echo "Second time - " . $assetsArr[1] . " with usdValue " . $data['BaseVolume'] * $usdValue ."\n";
                        }
                    } else {
                        if (!key_exists($assetsArr[1], $valuesArray)) {

                            echo "Updated " . $assetsArr[1] . "\n";

                            $valuesArray[$assetsArr[1]]['volumeUSD'] = $data['BaseVolume'];
                            $valuesArray[$assetsArr[1]]['time'] = $data['TimeStamp'];

                        } else {

                            echo "Second time updated " . $assetsArr[1] . "\n";
                            $valuesArray[$assetsArr[1]]['volumeUSD'] += $data['BaseVolume'];
                        }

                    }
            }

        }
        return $valuesArray;

    }

    private function findAsset($ticker)
    {
        return $this->entityManager->getRepository(Asset::class)->findOneBy(['ticker' => $ticker]);
    }

}