<?php

namespace Kami\StockBundle\Watcher;


use Doctrine\ORM\EntityManager;
use Kami\StockBundle\Model\Point;
use M6Web\Bundle\CassandraBundle\Cassandra\Client;

abstract class AbstractExchangeWatcher
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var Client
     */
    protected $client;

    /**
     *
     * @param Client $client
     * @param EntityManager $manager
     */
    public function __construct(Client $client, EntityManager $manager)
    {
        $this->entityManager = $manager;
        $this->client = $client;
    }

    abstract function updateAssetPrices();

    abstract function getUsdPrices(array $data);

    abstract function persistPoint(Point $point);

    abstract function findOrCreateAsset(array $tickerData);

    abstract function createNewPoint(array $tickerData);
}