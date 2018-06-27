<?php


namespace Kami\StockBundle\Watcher;

use Kami\StockBundle\Watcher\Binance\BinanceWatcher;
use Kami\StockBundle\Watcher\Bitfinex\BitfinexWatcher;
use Kami\StockBundle\Watcher\Bittrex\BittrexWatcher;

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
     * Watcher constructor.
     * @param BinanceWatcher $binanceWatcher
     * @param BitfinexWatcher $bitfinexWatcher
     * @param BittrexWatcher $bittrexWatcher
     */
    public function __construct(BinanceWatcher $binanceWatcher, BitfinexWatcher $bitfinexWatcher, BittrexWatcher $bittrexWatcher)
    {
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
        $this->binanceWatcher->updateAssetPrices();

        $this->bitfinexWatcher->updateAssetPrices();

        $this->bittrexWatcher->updateAssetPrices();
    }
}