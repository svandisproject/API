<?php

namespace Kami\StockBundle\Watcher\CoinMarketCap;

use Doctrine\ORM\EntityManager;
use GuzzleHttp\Client;
use Kami\AssetBundle\Entity\Asset;
use Kami\AssetBundle\Entity\CoinMarketCap;
use Psr\Log\LoggerInterface;

class CoinMarketCapWatcher
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * CoinMarketCapWatcher constructor.
     * @param EntityManager $entityManager
     */
    function __construct(EntityManager $entityManager, LoggerInterface $logger)
    {
        $this->em = $entityManager;
        $this->logger = $logger;
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
            while ($start <= $activeCryptocurrencies) {
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
                } catch (\Exception $e){
                    $this->logger->error('Could\'t update data from CoinMarketCap starting from ' . $start . " page.");
                }
            }
        } catch (\Exception $e){
            $this->logger->error('Could\'t update data from CoinMarketCap');
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
        if (!$asset = $this->em->getRepository(Asset::class)->findOneBy(['title' => $ticker])) {
            $asset = new Asset();
            $asset->setTitle($value['title']);
            $asset->setTicker($ticker);
            $this->em->persist($asset);
            $this->em->flush();
        }
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

        $this->em->persist($marketCap);
        $this->em->flush();
    }

}