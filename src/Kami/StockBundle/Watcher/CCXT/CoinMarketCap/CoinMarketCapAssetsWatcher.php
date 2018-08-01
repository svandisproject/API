<?php


namespace Kami\StockBundle\Watcher\CCXT\CoinMarketCap;

use ccxt\ExchangeError;
use ccxt\NetworkError;
use Doctrine\ORM\EntityManager;
use Kami\AssetBundle\Entity\Asset;
use Kami\AssetBundle\Entity\CoinMarketCap;
use Psr\Log\LoggerInterface;


class CoinMarketCapAssetsWatcher
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var LoggerInterface
     */
    protected $logger;

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

        $client = new \ccxt\coinmarketcap();

        try {
            $marketCapData = $client->fetch_tickers();

        } catch (NetworkError $e) {
            $this->logger->error('[Network Error] ' . $e->getMessage ());
        } catch (ExchangeError $e) {
            $this->logger->error('[Exchange Error] ' . $e->getMessage ());
        } catch (\Exception $e) {
            $this->logger->error('[Error] ' . $e->getMessage ());
        }
        if (isset($marketCapData)) {
            foreach ($marketCapData as $key => $data) {
               if (($volume = $data['info']['24h_volume_usd'] >= 1000) &&
                   $circulatingSupply = $data['info']['total_supply']) {
                   $value = [
                       'title' => $data['info']['name'],
                       'circulating_supply' => $circulatingSupply,
                       'volume' => $volume
                   ];
                            $asset = $this->findOrCreateAsset($data['info']['symbol'], $value);
                            $this->persistCoinMarketCap($asset, $value);
               }
            }
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
        if (!$asset = $this->em->getRepository(Asset::class)->findOneBy(['ticker' => $ticker])) {
            $asset = new Asset();
            $asset->setTitle($value['title']);
            $asset->setTicker($ticker);
            $this->em->persist($asset);
            $this->em->flush();
        } elseif ($asset->getTitle() !== $value['title']) {
            $asset->setTitle($value['title']);
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