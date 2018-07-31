<?php


namespace Kami\StockBundle\Watcher;

use Kami\StockBundle\Watcher\Bitfinex\BitfinexWatcher;
use Kami\StockBundle\Watcher\CCXT\Binance\BinanceAssetsWatcher;
use Kami\StockBundle\Watcher\CCXT\CoinMarketCap\CoinMarketCapAssetsWatcher;
use Kami\StockBundle\Watcher\Poloniex\PoloniexWatcher;
use Kami\StockBundle\Watcher\CCXT\Bittrex\BittrexAssetsWatcher;

class Watcher implements StockWatcherInterface
{

    /**
     * @var BinanceAssetsWatcher
     */
    public $binanceAssetsWatcher;

    /**
     * @var BitfinexWatcher
     */
    public $bitfinexWatcher;

    /**
     * @var PoloniexWatcher
     */
    public $poloniexWatcher;

    /**
     * @var BittrexAssetsWatcher
     */
    public $bittrexAssetsWatcher;

    /**
     * @var CoinMarketCapAssetsWatcher
     */
    private $coinMarketAssetsWatcher;

    /**
     * Watcher constructor.
     * @param BinanceAssetsWatcher $binanceAssetsWatcher
     * @param BitfinexWatcher $bitfinexWatcher
     * @param PoloniexWatcher $poloniexWatcher
     * @param CoinMarketCapAssetsWatcher $coinMarketAssetsCapWatcher
     * @param BittrexAssetsWatcher $bittrexAssetsWatcher
     */
    public function __construct(
                                BinanceAssetsWatcher $binanceAssetsWatcher,
                                BitfinexWatcher $bitfinexWatcher,
                                PoloniexWatcher $poloniexWatcher,
                                CoinMarketCapAssetsWatcher $coinMarketAssetsCapWatcher,
                                BittrexAssetsWatcher $bittrexAssetsWatcher
)
    {
        $this->poloniexWatcher = $poloniexWatcher;
        $this->binanceAssetsWatcher = $binanceAssetsWatcher;
        $this->bitfinexWatcher = $bitfinexWatcher;
        $this->coinMarketAssetsWatcher = $coinMarketAssetsCapWatcher;
        $this->bittrexAssetsWatcher = $bittrexAssetsWatcher;
    }

    /**
     * Returns graph points to store
     * @throws \Exception
     * @throws \Cassandra\Exception
     */
    public function tick()
    {

        $this->bittrexAssetsWatcher->updateAssetPrices();

        $this->poloniexWatcher->updateAssetPrices();

        $this->binanceAssetsWatcher->updateAssetPrices();

        $this->bitfinexWatcher->updateAssetPrices();

        $this->coinMarketAssetsWatcher->sync();

    }
}