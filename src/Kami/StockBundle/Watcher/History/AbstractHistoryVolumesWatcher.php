<?php

namespace Kami\StockBundle\Watcher\History;


use Cassandra;
use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;
use GuzzleHttp\Client as HttpClient;
use Predis\Client;

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
      * @var Client
      */
     protected $redis;

    /**
     * AbstractVolumeWatcher constructor.
     * @param EntityManager $entityManager
     * @param LoggerInterface $logger
     * @param Client $redis
     */
    public function __construct(
        EntityManager $entityManager,
        LoggerInterface $logger,
        Client $redis
    )
    {
        $cluster = Cassandra::cluster()
            ->withIOThreads(4)
            ->build();
        $this->client = $cluster->connect();
        $this->entityManager = $entityManager;
        $this->logger = $logger;
        $this->redis = $redis;
        $this->httpClient = new HttpClient();
    }

    abstract public function updateVolumes();

}