<?php


namespace Kami\StockBundle\Watcher;

use Doctrine\ORM\EntityManager;
use Kami\AssetBundle\Entity\Asset;
use Kami\AssetBundle\Entity\Volume;
use Kami\StockBundle\Watcher\Bittrex\Utils\BittrexClient;
use Psr\Log\LoggerInterface;
use GuzzleHttp\Client as HttpClient;

abstract class AbstractVolumesWatcher
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var bool
     */
    protected $useProxy = false;

    /**
     * @var BittrexClient
     */
    protected $bittrexClient;

    /**
     * AbstractVolumeWatcher constructor.
     * @param EntityManager $manager
     * @param LoggerInterface $logger
     * @param BittrexClient $bittrexClient
     * @param string $proxy
     */
    public function __construct(
        EntityManager $manager,
        LoggerInterface $logger,
        BittrexClient $bittrexClient,
        $proxy)
    {
        $this->entityManager = $manager;
        $this->logger = $logger;
        $this->bittrexClient = $bittrexClient;

        if ($this->useProxy) {
            $this->httpClient = new HttpClient(['proxy'=>$proxy]);
        }
    }

    abstract public function updateVolumes();

    /**
     * @param Asset $asset
     * @param array $volumeData
     */
    protected function persistVolumes(Asset $asset, $volumeData)
    {
        $volume = new Volume();
        $volume->setAsset($asset);

        $volume->setVolumeUsd($volumeData['volumeUSD']);
        $volume->setAddedTime(\DateTime::createFromFormat('Y-m-d?G:i:s.u', $volumeData['time']));

        $this->entityManager->persist($volume);
        $this->entityManager->flush();
    }
}