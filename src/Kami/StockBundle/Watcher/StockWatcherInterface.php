<?php


namespace Kami\StockBundle\Watcher;

use Kami\StockBundle\Watcher\Binance\BinanceWatcher;
use Kami\StockBundle\Watcher\Bitfinex\BitfinexWatcher;
use Kami\StockBundle\Watcher\Bittrex\BittrexWatcher;
use Kami\StockBundle\Watcher\CoinMarketCap\CoinMarketCapWatcher;
use Kami\StockBundle\Watcher\Poloniex\PoloniexWatcher;

interface StockWatcherInterface
{
    public function __construct(BinanceWatcher $binanceWatcher,
                                BitfinexWatcher $bitfinexWatcher,
                                BittrexWatcher $bittrexWatcher,
                                PoloniexWatcher $poloniexWatcher,
                                CoinMarketCapWatcher $coinMarketCapWatcher);

    /**
     * Returns graph points to store
     */
    public function tick();

}