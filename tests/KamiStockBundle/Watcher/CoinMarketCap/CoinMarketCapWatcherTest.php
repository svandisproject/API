<?php


namespace Tests\KamiStockBundle\Watcher\CoinMarketCap;


use Doctrine\ORM\EntityManager;
use Kami\AssetBundle\Entity\Asset;
use Kami\AssetBundle\Repository\AssetRepository;
use Kami\StockBundle\Watcher\CoinMarketCap\CoinMarketCapWatcher;
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
        $em->expects($this->any())->method('getRepository')->willReturn($assetRepoMock);
        $watcher = new CoinMarketCapWatcher($em);
        $this->assertNull($watcher->sync());
    }
}