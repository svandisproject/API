<?php


namespace Kami\StockBundle\Watcher\History;

use Kami\StockBundle\Watcher\History\HistoryExchangeVolumesWatcher;

class HistoryVolumesWatcher
{

    /**
     * @var HistoryExchangeVolumesWatcher
     */
    public $exchangeVolumesWatcher;

    /**
     * HistoryWatcher constructor.
     *
     * @param HistoryExchangeVolumesWatcher $exchangeVolumesWatcher
     *
     */
    public function __construct(HistoryExchangeVolumesWatcher $exchangeVolumesWatcher)
    {
        $this->exchangeVolumesWatcher = $exchangeVolumesWatcher;
    }

    public function tick()
    {

        $this->exchangeVolumesWatcher->updateVolumes();

    }

}