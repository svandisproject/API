<?php


namespace Kami\StockBundle\Watcher;

use Kami\StockBundle\Watcher\Binance\BinanceWatcher;
use Kami\StockBundle\Watcher\Bitfinex\BitfinexWatcher;
use Kami\StockBundle\Watcher\Bittrex\BittrexWatcher;
use Kami\StockBundle\Watcher\Poloniex\PoloniexWatcher;

class Watcher implements StockWatcherInterface
{
    /**
     * @var BinanceWatcher
     */
    public $binanceWatcher;

    /**
     * @var BittrexWatcher
     */
    public $bittrexWatcher;

    /**
     * @var BitfinexWatcher
     */
    public $bitfinexWatcher;

    /**
     * @var PoloniexWatcher
     */
    public $poloniexWatcher;

    /**
     * Watcher constructor.
     * @param BinanceWatcher $binanceWatcher
     * @param BitfinexWatcher $bitfinexWatcher
     * @param BittrexWatcher $bittrexWatcher
     * @param PoloniexWatcher $poloniexWatcher
     */
    public function __construct(BinanceWatcher $binanceWatcher,
                                BitfinexWatcher $bitfinexWatcher,
                                BittrexWatcher $bittrexWatcher,
                                PoloniexWatcher $poloniexWatcher)
    {
        $this->poloniexWatcher = $poloniexWatcher;
        $this->binanceWatcher = $binanceWatcher;
        $this->bitfinexWatcher = $bitfinexWatcher;
        $this->bittrexWatcher = $bittrexWatcher;
    }

    /**
     * Returns graph points to store
     * @throws \Exception
     * @throws \Cassandra\Exception
     */
    public function tick()
    {
        $this->poloniexWatcher->updateAssetPrices();

        $this->binanceWatcher->updateAssetPrices();

        $this->bitfinexWatcher->updateAssetPrices();

        $this->bittrexWatcher->updateAssetPrices();
    }
}