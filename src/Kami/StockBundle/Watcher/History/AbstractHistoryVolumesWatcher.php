<?php

namespace Kami\StockBundle\Watcher\History;


use Cassandra;
use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;
use GuzzleHttp\Client as HttpClient;
use Predis\Client;
use M6Web\Bundle\CassandraBundle\Cassandra\Client as CassandraClient;

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
     * @param CassandraClient $cassandra
     */
    public function __construct(
        EntityManager $entityManager,
        LoggerInterface $logger,
        Client $redis,
        CassandraClient $cassandra
    )
    {
        $this->client = $cassandra;
        $this->entityManager = $entityManager;
        $this->logger = $logger;
        $this->redis = $redis;
        $this->httpClient = new HttpClient();
    }

    abstract public function updateVolumes();

}