<?php


namespace Kami\StockBundle\Watcher\History;

use GuzzleHttp\Client as HttpClient;
use Doctrine\ORM\EntityManager;
use Kami\AssetBundle\Entity\Asset;
use Psr\Log\LoggerInterface;
use M6Web\Bundle\CassandraBundle\Cassandra\Client as CassandraClient;

 abstract class AbstractHistoryExchangeWatcher
{

     /**
      * @var HttpClient
      */
     protected $httpClient;

     /**
      * @var EntityManager $em
      */
     protected $em;

     /**
      * @var CassandraClient
      */
     protected $client;

     /**
      * @var LoggerInterface
      */
     protected $logger;

     public function __construct( CassandraClient $client, EntityManager $manager, LoggerInterface $logger)
     {
         $this->em = $manager;

         $this->httpClient = new HttpClient();

         $this->logger = $logger;

         $this->client = $client;
     }

     abstract public function syncHistory();


     protected function getAssets()
     {
         return $this->em->getRepository(Asset::class)->findAll();
     }

}