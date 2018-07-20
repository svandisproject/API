<?php


namespace Tests\KamiStockBundle\Watcher\Poloniex;

use Doctrine\ORM\EntityManager;
use Kami\AssetBundle\Entity\Asset;
use Kami\AssetBundle\Repository\AssetRepository;
use Kami\StockBundle\Watcher\Bittrex\Utils\BittrexClient;
use Kami\StockBundle\Watcher\Poloniex\PoloniexVolumeWatcher;
use Predis\Client;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Tests\Functional\WebTestCase;

class PoloniexVolumeWatcherTest extends WebTestCase
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
        $client = $this->createMock(BittrexClient::class);
        $redis = $this->createMock(Client::class);
        $watcher = new PoloniexVolumeWatcher($em, $logger, $client, $redis, 'http://vw520rzfhacf1p:5eQVQyie4_ILLX_YOtlsvDqmCw@eu-west-static-01.quotaguard.com:9293');
        $this->assertNull($watcher->updateVolumes());
    }
}