<?php


namespace Tests\KamiStockBundle\Watcher\Bittrex;

use Doctrine\ORM\EntityManager;
use Kami\AssetBundle\Entity\Asset;
use Kami\AssetBundle\Repository\AssetRepository;
use Kami\StockBundle\Watcher\Bittrex\BittrexVolumeWatcher;
use Kami\StockBundle\Watcher\Bittrex\Utils\BittrexClient;
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

        $markets = [
            ["BTC-2GIVE" => [
                "Volume" => 11111.11111,
                "BaseVolume" => 0.11111,
                "TimeStamp" => "2018-07-11T13:29:14.16"
                ]
            ]
        ];
        $ticker = new \stdClass();
        $ticker->result = new \stdClass();
        $ticker->result->Last = 6331.598;

        $client = $this->createMock(BittrexClient::class);
        $client->expects($this->any())->method('getTicker')->willReturn($ticker);
        $client->expects($this->any())->method('getMarketsSummaries')->willReturn($markets);
        $watcher = new BittrexVolumeWatcher($em, $logger, $client, false);
        $this->assertNull($watcher->updateVolumes());
    }
}