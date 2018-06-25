<?php


namespace Kami\StockBundle\Watcher;

use Doctrine\ORM\EntityManager;
use Kami\StockBundle\Watcher\Binance\BinanceWatcher;
use M6Web\Bundle\CassandraBundle\Cassandra\Client;

class Watcher
{
    public function execute(Client $client, EntityManager $entityManager)
    {
        $binanceWatcher = new BinanceWatcher($client, $entityManager);
        $binanceWatcher->getAssetPrices();
    }

}