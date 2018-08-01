<?php


namespace Kami\StockBundle\Watcher;

use Kami\StockBundle\Watcher\Bitfinex\BitfinexWatcher;
use Kami\StockBundle\Watcher\CCXT\Binance\BinanceAssetsWatcher;
use Kami\StockBundle\Watcher\CCXT\Bittrex\BittrexAssetsWatcher;
use Kami\StockBundle\Watcher\CCXT\CoinMarketCap\CoinMarketCapAssetsWatcher;
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