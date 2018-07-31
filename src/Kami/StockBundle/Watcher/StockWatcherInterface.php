<?php


namespace Kami\StockBundle\Watcher;

use Kami\StockBundle\Watcher\Bitfinex\BitfinexWatcher;
use Kami\StockBundle\Watcher\CCXT\Binance\BinanceAssetsWatcher;
use Kami\StockBundle\Watcher\CCXT\Bittrex\BittrexAssetsWatcher;
use Kami\StockBundle\Watcher\CoinMarketCap\CoinMarketCapWatcher;
use Kami\StockBundle\Watcher\Poloniex\PoloniexWatcher;

interface StockWatcherInterface
{
    public function __construct(
                                BinanceAssetsWatcher $binanceAssetsWatcher,
                                BitfinexWatcher $bitfinexWatcher,
                                PoloniexWatcher $poloniexWatcher,
                                CoinMarketCapWatcher $coinMarketCapWatcher,
                                BittrexAssetsWatcher $bittrexAssetsWatcher
    );

    /**
     * Returns graph points to store
     */
    public function tick();

}