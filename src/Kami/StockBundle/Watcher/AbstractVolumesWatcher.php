<?php


namespace Kami\StockBundle\Watcher;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Kami\AssetBundle\Entity\Asset;
use Kami\AssetBundle\Entity\Volume;
use Predis\Client;
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
     * @var Client
     */
    protected $redis;

    /**
     * AbstractVolumeWatcher constructor.
     * @param EntityManager $manager
     * @param LoggerInterface $logger
     * @param Client $redis
     * @param string $proxy
     */
    public function __construct(
        EntityManager $manager,
        LoggerInterface $logger,
        Client $redis,
        $proxy
    )
    {
        $this->entityManager = $manager;
        $this->logger = $logger;
        $this->redis = $redis;

        if ($this->useProxy) {
            $this->httpClient = new HttpClient(['proxy'=>$proxy]);
        }
    }

    abstract public function updateVolumes();

    /**
     * @param Asset $asset
     * @param float $usdVolume
     * @param string $exchange
     *
     * @throws ORMInvalidArgumentException
     * @throws ORMException
     */
    protected function persistVolumes(Asset $asset, $usdVolume, $exchange)
    {
        if($data = $this->redis->get($asset->getTicker())){
            $newData = json_decode($data);
            $newData->$exchange = $usdVolume;
            $this->redis->set($asset->getTicker(), json_encode($newData));
        } else{
            $this->redis->set($asset->getTicker(), json_encode([$exchange => $usdVolume]));
        }
        $volume = new Volume();
        $volume->setAsset($asset);
        $volume->setVolumeUsd($usdVolume);
        $volume->setAddedTime(time());
        $volume->setExchange($exchange);

        $this->entityManager->persist($volume);
        $this->entityManager->flush();
    }

    /**
     * @param string $ticker
     *
     * @return Asset
     */
    protected function findAsset($ticker): Asset
    {
        return $this->entityManager->getRepository(Asset::class)->findOneBy(['ticker' => $ticker]);
    }
}