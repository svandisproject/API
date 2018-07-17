<?php


namespace Kami\StockBundle\Watcher;


use Kami\StockBundle\Watcher\Bitfinex\BitfinexVolumeWatcher;
use Kami\StockBundle\Watcher\Bittrex\BittrexVolumeWatcher;
use Kami\StockBundle\Watcher\Binance\BinanceVolumeWatcher;
use Kami\StockBundle\Watcher\Poloniex\PoloniexVolumeWatcher;

class VolumesWatcher
{
    /**
     * @var BittrexVolumeWatcher
     */
    public $bittrexVolumeWatcher;

    /**
     * @var BinanceVolumeWatcher
     */
    public $binanceVolumeWatcher;

    /**
     * @var PoloniexVolumeWatcher
     */
    public $poloniexVolumeWatcher;

    /**
     * @var BitfinexVolumeWatcher
     */
    public $bitfinexVolumeWatcher;

    /**
     * VolumesWatcher constructor.
     * @param BittrexVolumeWatcher $bittrexVolumeWatcher
     * @param BinanceVolumeWatcher $binanceVolumeWatcher
     * @param BitfinexVolumeWatcher $bitfinexVolumeWatcher
     * @param PoloniexVolumeWatcher $poloniexVolumeWatcher
     */
    function __construct(
        BittrexVolumeWatcher $bittrexVolumeWatcher,
        BinanceVolumeWatcher $binanceVolumeWatcher,
        BitfinexVolumeWatcher $bitfinexVolumeWatcher,
        PoloniexVolumeWatcher $poloniexVolumeWatcher
    )
    {
        $this->bittrexVolumeWatcher = $bittrexVolumeWatcher;
        $this->binanceVolumeWatcher = $binanceVolumeWatcher;
        $this->bitfinexVolumeWatcher = $bitfinexVolumeWatcher;
        $this->poloniexVolumeWatcher = $poloniexVolumeWatcher;
    }

    public function getVolumes()
    {
        $this->bittrexVolumeWatcher->updateVolumes();
        $this->binanceVolumeWatcher->updateVolumes();
        $this->bitfinexVolumeWatcher->updateVolumes();
        $this->poloniexVolumeWatcher->updateVolumes();
    }

}