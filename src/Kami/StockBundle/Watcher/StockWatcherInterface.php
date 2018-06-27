<?php


namespace Kami\StockBundle\Watcher;

use Kami\StockBundle\Watcher\Binance\BinanceWatcher;
use Kami\StockBundle\Watcher\Bitfinex\BitfinexWatcher;

interface StockWatcherInterface
{
    public function __construct(BinanceWatcher $binanceWatcher, BitfinexWatcher $bitfinexWatcher);

    /**
     * Returns graph points to store
     */
    public function tick();

}