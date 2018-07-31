<?php


namespace Kami\StockBundle\Watcher;

use Kami\StockBundle\Watcher\Binance\BinanceWatcher;
use Kami\StockBundle\Watcher\Bitfinex\BitfinexWatcher;
use Kami\StockBundle\Watcher\Bittrex\BittrexWatcher;
use Kami\StockBundle\Watcher\CoinMarketCap\CoinMarketCapWatcher;
use Kami\StockBundle\Watcher\Poloniex\PoloniexWatcher;
use Kami\StockBundle\Watcher\CCXT\CcxtWatcher;

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
     * @var CcxtWatcher
     */
    public $ccxtWatcher;

    /**
     * @var CoinMarketCapWatcher
     */
    private $coinMarketWatcher;

    /**
     * Watcher constructor.
     * @param BinanceWatcher $binanceWatcher
     * @param BitfinexWatcher $bitfinexWatcher
     * @param BittrexWatcher $bittrexWatcher
     * @param PoloniexWatcher $poloniexWatcher
     * @param CoinMarketCapWatcher $coinMarketCapWatcher
     * @param CcxtWatcher $ccxtWatcher
     */
    public function __construct(BinanceWatcher $binanceWatcher,
                                BitfinexWatcher $bitfinexWatcher,
                                BittrexWatcher $bittrexWatcher,
                                PoloniexWatcher $poloniexWatcher,
                                CoinMarketCapWatcher $coinMarketCapWatcher,
                                CcxtWatcher $ccxtWatcher
)
    {
        $this->poloniexWatcher = $poloniexWatcher;
        $this->binanceWatcher = $binanceWatcher;
        $this->bitfinexWatcher = $bitfinexWatcher;
        $this->bittrexWatcher = $bittrexWatcher;
        $this->coinMarketWatcher = $coinMarketCapWatcher;
        $this->ccxtWatcher = $ccxtWatcher;
    }

    /**
     * Returns graph points to store
     * @throws \Exception
     * @throws \Cassandra\Exception
     */
    public function tick()
    {
        $this->ccxtWatcher->updateAssetPrices();

//        $this->poloniexWatcher->updateAssetPrices();
//
//        $this->binanceWatcher->updateAssetPrices();
//
//        $this->bitfinexWatcher->updateAssetPrices();
//
//        $this->bittrexWatcher->updateAssetPrices();
//
//        $this->coinMarketWatcher->sync();

    }
}