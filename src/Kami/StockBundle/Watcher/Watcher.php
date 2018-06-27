<?php


namespace Kami\StockBundle\Watcher;

use Kami\StockBundle\Watcher\Binance\BinanceWatcher;
use Kami\StockBundle\Watcher\Bitfinex\BitfinexWatcher;

class Watcher implements StockWatcherInterface
{
    /**
     * @var BinanceWatcher
     */
    public $binanceWatcher;

    /**
     * @var BitfinexWatcher
     */
    public $bitfinexWatcher;

    /**
     * Watcher constructor.
     * @param BinanceWatcher $binanceWatcher
     * @param BitfinexWatcher $bitfinexWatcher
     */
    public function __construct(BinanceWatcher $binanceWatcher, BitfinexWatcher $bitfinexWatcher)
    {
        $this->binanceWatcher = $binanceWatcher;
        $this->bitfinexWatcher = $bitfinexWatcher;
    }

    /**
     * Returns graph points to store
     * @throws \Exception
     * @throws \Cassandra\Exception
     */
    public function tick()
    {
        $this->binanceWatcher->updateAssetPrices();

        $this->bitfinexWatcher->updateAssetPrices();
    }
}