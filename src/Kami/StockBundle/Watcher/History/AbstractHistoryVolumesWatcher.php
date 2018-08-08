<?php

namespace Kami\StockBundle\Watcher\History;


use M6Web\Bundle\CassandraBundle\Cassandra\Client as CassandraClient;
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
    * @var CassandraClient
    */
    protected $client;

    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * AbstractVolumeWatcher constructor.
     * @param CassandraClient $client
     * @param EntityManager $entityManager
     * @param LoggerInterface $logger
     */
    public function __construct(
        CassandraClient $client,
        EntityManager $entityManager,
        LoggerInterface $logger
    )
    {
        $this->client = $client;
        $this->entityManager = $entityManager;
        $this->logger = $logger;
        $this->httpClient = new HttpClient();
    }

    abstract public function updateVolumes();

}