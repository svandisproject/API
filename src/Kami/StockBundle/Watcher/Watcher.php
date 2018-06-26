<?php


namespace Kami\StockBundle\Watcher;

use Doctrine\ORM\EntityManager;
use Kami\StockBundle\Watcher\Binance\BinanceWatcher;
use M6Web\Bundle\CassandraBundle\Cassandra\Client;

class Watcher implements StockWatcherInterface
{
    public function execute(Client $client, EntityManager $entityManager)
    {
        $binanceWatcher = new BinanceWatcher($client, $entityManager);
        $binanceWatcher->updateAssetPrices();
    }

    /**
     * Returns graph points to store
     *
     * @return array<Point>
     */
    public function tick() : array
    {

    }
}