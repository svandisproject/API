<?php

namespace Kami\StockBundle\Watcher\History;


use Cassandra;
use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;
use GuzzleHttp\Client as HttpClient;

 abstract class AbstractHistoryVolumesWatcher
{

     /**
      * @var EntityManager $entityManager
      */
    protected $entityManager;

    /**
    * @var Cassandra
    */
    protected $client;

    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * AbstractVolumeWatcher constructor.
     * @param EntityManager $entityManager
     * @param LoggerInterface $logger
     */
    public function __construct(
        EntityManager $entityManager,
        LoggerInterface $logger
    )
    {
        $cluster = Cassandra::cluster()
            ->withContactPoints(['34.247.150.247', '34.254.25.212', '34.247.192.31'])
            ->withPort(9042)
            ->withIOThreads(4)
            ->build();
        $this->client = $cluster->connect();
        $this->entityManager = $entityManager;
        $this->logger = $logger;
        $this->httpClient = new HttpClient();
    }

    abstract public function updateVolumes();

}