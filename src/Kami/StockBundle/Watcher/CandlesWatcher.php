<?php


namespace Kami\StockBundle\Watcher;

use Kami\StockBundle\Watcher\Binance\BinanceCandlesWatcher;
use Kami\StockBundle\Watcher\Bitfinex\BitfinexCandlesWatcher;

class CandlesWatcher implements CandlesWatcherInterface
{

    /**
     * @var BinanceCandlesWatcher
     */
    private $binanceCandlesWatcher;

    /**
     * @var BitfinexCandlesWatcher
     */
    private $bitfinexCandlesWatcher;


    public function __construct(BinanceCandlesWatcher $baninceCandlesWatcher, BitfinexCandlesWatcher $bitfinexCandlesWatcher)
    {
        $this->binanceCandlesWatcher = $baninceCandlesWatcher;
        $this->bitfinexCandlesWatcher = $bitfinexCandlesWatcher;
    }

    public function tick()
    {
//        $this->binanceCandlesWatcher->updateAssetCandles();
        $this->bitfinexCandlesWatcher->updateAssetCandles();
    }

}