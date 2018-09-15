<?php


namespace Tests\KamiStockBundle\Watcher\Bittrex;

use Doctrine\ORM\EntityManager;
use Kami\AssetBundle\Entity\Asset;
use Kami\AssetBundle\Repository\AssetRepository;
use Kami\StockBundle\Watcher\Bittrex\BittrexWatcher;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Tests\Functional\WebTestCase;
use M6Web\Bundle\CassandraBundle\Cassandra\Client;
use Predis\Client as Redis;

class BittrexWatcherTest extends WebTestCase
{
    public function testUpdateAssetPrices()
    {
        $asset = new Asset();
        $asset->setPrice(1);
        $asset->setTicker('TEST');
        $assetRepoMock = $this->createMock(AssetRepository::class);
        $assetRepoMock->expects($this->any())->method('findOneBy')->willReturn($asset);
        $em = $this->createMock(EntityManager::class);
        $em->expects($this->any())->method('getRepository')->willReturn($assetRepoMock);
        $logger = $this->createMock(LoggerInterface::class);
        $client = $this->createMock(Client::class);
        $redis = $this->createMock(Redis::class);
        $client->expects($this->any())->method('prepare')->willReturn('');
        $watcher = new BittrexWatcher($client, $em, $logger, $redis, false);
        $this->assertNull($watcher->updateAssetPrices());
    }
}