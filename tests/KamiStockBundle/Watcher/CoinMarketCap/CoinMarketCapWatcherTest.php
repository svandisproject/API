<?php


namespace Tests\KamiStockBundle\Watcher\CoinMarketCap;


use Doctrine\ORM\EntityManager;
use Kami\AssetBundle\Entity\Asset;
use Kami\AssetBundle\Repository\AssetRepository;
use Psr\Log\LoggerInterface;
use Kami\StockBundle\Watcher\CCXT\CoinMarketCap\CoinMarketCapAssetsWatcher;
use Symfony\Bundle\FrameworkBundle\Tests\Functional\WebTestCase;

class CoinMarketCapWatcherTest extends WebTestCase
{
    public function testSync()
    {
        $asset = new Asset();
        $asset->setPrice(1);
        $asset->setTicker('TEST');
        $assetRepoMock = $this->createMock(AssetRepository::class);
        $assetRepoMock->expects($this->any())->method('findOneBy')->willReturn($asset);
        $em = $this->createMock(EntityManager::class);
        $logger = $this->createMock(LoggerInterface::class);
        $em->expects($this->any())->method('getRepository')->willReturn($assetRepoMock);
        $watcher = new CoinMarketCapAssetsWatcher($em, $logger);
        $this->assertNull($watcher->sync());
    }
}