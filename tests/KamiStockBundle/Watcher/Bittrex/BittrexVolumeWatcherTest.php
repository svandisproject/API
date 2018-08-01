<?php


namespace Tests\KamiStockBundle\Watcher\Bittrex;

use Doctrine\ORM\EntityManager;
use Kami\AssetBundle\Entity\Asset;
use Kami\AssetBundle\Repository\AssetRepository;
use Kami\StockBundle\Watcher\CCXT\Bittrex\BittrexVolumesWatcher;
use Predis\Client;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Tests\Functional\WebTestCase;

class BinanceVolumeWatcherTest extends WebTestCase
{
    public function testUpdateVolumes()
    {
        $asset = new Asset();
        $asset->setPrice(1);
        $asset->setTicker('TEST');
        $assetRepoMock = $this->createMock(AssetRepository::class);
        $assetRepoMock->expects($this->any())->method('findOneBy')->willReturn($asset);
        $em = $this->createMock(EntityManager::class);
        $em->expects($this->any())->method('getRepository')->willReturn($assetRepoMock);
        $logger = $this->createMock(LoggerInterface::class);

        $redis = $this->createMock(Client::class);
        $watcher = new BittrexVolumesWatcher($em, $logger, $redis, false);
        $this->assertNull($watcher->updateVolumes());
    }
}