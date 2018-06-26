<?php


namespace Kami\StockBundle\Watcher;

use Doctrine\ORM\EntityManager;
use Kami\StockBundle\Watcher\Binance\BinanceWatcher;
use Kami\StockBundle\Watcher\Bitfinex\BitfinexWatcher;
use M6Web\Bundle\CassandraBundle\Cassandra\Client;

class Watcher implements StockWatcherInterface
{
    public function execute(Client $client, EntityManager $entityManager)
    {
        $binanceWatcher = new BinanceWatcher($client, $entityManager);
        $binanceWatcher->updateAssetPrices();

        $bitfinexWatcher = new BitfinexWatcher($client, $entityManager);
        $bitfinexWatcher->updateAssetPrices();
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