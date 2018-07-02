<?php


namespace Kami\StockBundle\Watcher;


use Kami\StockBundle\Watcher\Bittrex\BittrexVolumeWatcher;

class VolumesWatcher
{
    /**
     * @var BittrexVolumeWatcher
     */
    public $bittrexVolumeWatcher;

    function __construct(
        BittrexVolumeWatcher $bittrexVolumeWatcher
    )
    {
        $this->bittrexVolumeWatcher = $bittrexVolumeWatcher;
    }

    public function getVolumes()
    {
        $this->bittrexVolumeWatcher->updateVolumes();
    }

}