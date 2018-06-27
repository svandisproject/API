<?php


namespace Kami\StockBundle\Watcher;

use Kami\StockBundle\Watcher\Binance\BinanceWatcher;
use Kami\StockBundle\Watcher\Bitfinex\BitfinexWatcher;
use Kami\StockBundle\Watcher\Bittrex\BittrexWatcher;

interface StockWatcherInterface
{
    public function __construct(BinanceWatcher $binanceWatcher, BitfinexWatcher $bitfinexWatcher, BittrexWatcher $bittrexWatcher);

    /**
     * Returns graph points to store
     */
    public function tick();

}