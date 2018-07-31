<?php


namespace Kami\StockBundle\Watcher;

use Kami\StockBundle\Watcher\Binance\BinanceWatcher;
use Kami\StockBundle\Watcher\Bitfinex\BitfinexWatcher;
use Kami\StockBundle\Watcher\Bittrex\BittrexWatcher;
use Kami\StockBundle\Watcher\CoinMarketCap\CoinMarketCapWatcher;
use Kami\StockBundle\Watcher\Poloniex\PoloniexWatcher;

interface StockWatcherInterface
{
    public function __construct(
                                BinanceAssetsWatcher $binanceAssetsWatcher,
                                BitfinexWatcher $bitfinexWatcher,
                                PoloniexWatcher $poloniexWatcher,
                                CoinMarketCapAssetsWatcher $coinMarketAssetsCapWatcher,
                                BittrexAssetsWatcher $bittrexAssetsWatcher
    );

    /**
     * Returns graph points to store
     */
    public function tick();

}