<?php

namespace Kami\StockBundle\Watcher\CoinMarketCap;

use Doctrine\ORM\EntityManager;
use GuzzleHttp\Client;
use Kami\AssetBundle\Entity\Asset;
use Kami\AssetBundle\Entity\CoinMarketCap;

class CoinMarketCapWatcher
{
    /**
     * @var EntityManager
     */
    private $em;

    function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @throws \Exception
     */
    public function sync()
    {
        $client = new Client();

        try{
            $globalData = $client->get('https://api.coinmarketcap.com/v2/global/');
            $activeCryptocurrencies = json_decode($globalData->getBody()->getContents())->data->active_cryptocurrencies;

            $start = 0;
            do{
                try{
                    $response = $client->get("https://api.coinmarketcap.com/v2/ticker?structure=array&start=$start");
                    $responseData = json_decode($response->getBody()->getContents())->data;
                    foreach ($responseData as $data){
                        if ((($volume = $data->quotes->USD->volume_24h) >= 1000) &&
                            $circulatingSupply = $data->circulating_supply) {
                            $value = [
                                'title' => $data->name,
                                'circulating_supply' => $circulatingSupply,
                                'volume' => $volume
                            ];
                            $asset = $this->findOrCreateAsset($data->symbol, $value);
                            $this->persistCoinMarketCap($asset, $value);
                        }
                    }
                    $start += 100;
                } catch (\Exception $e){
                    echo $e->getMessage();
                }
            } while($start < $activeCryptocurrencies);
        } catch (\Exception $e){
            echo $e->getMessage();
        }

    }

    /**
     * @param string $ticker
     * @param array $value
     *
     * @throws \Exception
     *
     * @return Asset
     */
    private function findOrCreateAsset($ticker, $value): Asset
    {
        if ($asset = $this->em->getRepository(Asset::class)->findOneBy(['ticker' => $ticker])) {
            if($asset->getTitle() == null){
                $asset->setTitle($value['title']);
                $this->em->persist($asset);
                $this->em->flush();
            }
            return $asset;
        }

        $asset = new Asset();
        $asset->setTitle($value['title']);
        $asset->setTicker($ticker);
        $this->em->persist($asset);
        $this->em->flush();

        return $asset;
    }

    /**
     * @param Asset $asset
     * @param array $value
     * @throws \Exception
     */
    private function persistCoinMarketCap($asset, $value)
    {

        if (!$marketCap = $asset->getMarketCap()) {
            $marketCap = new CoinMarketCap();
        }
        $marketCap->setAsset($asset);
        $marketCap->setCirculatingSupply($value['circulating_supply']);
        $marketCap->setVolume24($value['volume']);
        $marketCap->setMarketCap($value['circulating_supply'] * $asset->getPrice());

        $this->em->persist($marketCap);
        $this->em->flush();
    }

}