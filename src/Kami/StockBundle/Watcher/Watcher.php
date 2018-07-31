<?php


namespace Kami\StockBundle\Watcher;

use Kami\StockBundle\Watcher\Bitfinex\BitfinexWatcher;
use Kami\StockBundle\Watcher\CCXT\Binance\BinanceAssetsWatcher;
use Kami\StockBundle\Watcher\CoinMarketCap\CoinMarketCapWatcher;
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
     * @var CcxtWatcher
     */
    public $bittrexAssetsWatcher;

    /**
     * @var CoinMarketCapWatcher
     */
    private $coinMarketWatcher;

    /**
     * Watcher constructor.
     * @param BinanceAssetsWatcher $binanceAssetsWatcher
     * @param BitfinexWatcher $bitfinexWatcher
     * @param PoloniexWatcher $poloniexWatcher
     * @param CoinMarketCapWatcher $coinMarketCapWatcher
     * @param BittrexAssetsWatcher $bittrexAssetsWatcher
     */
    public function __construct(
                                BinanceAssetsWatcher $binanceAssetsWatcher,
                                BitfinexWatcher $bitfinexWatcher,
                                PoloniexWatcher $poloniexWatcher,
                                CoinMarketCapWatcher $coinMarketCapWatcher,
                                BittrexAssetsWatcher $bittrexAssetsWatcher
)
    {
        $this->poloniexWatcher = $poloniexWatcher;
        $this->binanceAssetsWatcher = $binanceAssetsWatcher;
        $this->bitfinexWatcher = $bitfinexWatcher;
        $this->coinMarketWatcher = $coinMarketCapWatcher;
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

        $this->coinMarketWatcher->sync();

    }
}