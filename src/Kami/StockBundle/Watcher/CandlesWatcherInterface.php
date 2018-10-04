<?php


namespace Kami\StockBundle\Watcher;

use Kami\StockBundle\Watcher\Binance\BinanceCandlesWatcher;
use Kami\StockBundle\Watcher\Bitfinex\BitfinexCandlesWatcher;

interface CandlesWatcherInterface
{

    public function __construct(
        BinanceCandlesWatcher $binanceCandlesWatcher,
        BitfinexCandlesWatcher $bitfinexCandlesWatcher
    );

    /**
     * Returns graph points to store
     */
    public function tick();

}