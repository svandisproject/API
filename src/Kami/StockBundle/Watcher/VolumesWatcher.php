<?php


namespace Kami\StockBundle\Watcher;


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

    function __construct(
        BittrexVolumeWatcher $bittrexVolumeWatcher,
        BinanceVolumeWatcher $binanceVolumeWatcher,
        PoloniexVolumeWatcher $poloniexVolumeWatcher
    )
    {
        $this->bittrexVolumeWatcher = $bittrexVolumeWatcher;
        $this->binanceVolumeWatcher = $binanceVolumeWatcher;
        $this->poloniexVolumeWatcher = $poloniexVolumeWatcher;
    }

    public function getVolumes()
    {
        $this->bittrexVolumeWatcher->updateVolumes();

        $this->binanceVolumeWatcher->updateVolumes();

        $this->poloniexVolumeWatcher->updateVolumes();

    }

}