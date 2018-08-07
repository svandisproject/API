<?php


namespace Kami\StockBundle\Watcher\History;

use Kami\StockBundle\Watcher\History\CoinsHistoryWatcher;
use Kami\StockBundle\Watcher\History\AvailableExchangesHistoryWatcher;

class HistoryWatcher
{

    /**
     * @var CoinsHistoryWatcher
     */
    public $coinsWatcher;

    /**
     * @var AvailableExchangesHistoryWatcher
     */
    public $exchangeHistoryWatcher;

    /**
     * HistoryWatcher constructor.
     *
     * @param CoinsHistoryWatcher $coinsHistoryWatcher
     * @param AvailableExchangesHistoryWatcher $exchangeHistoryWatcher
     */
    public function __construct(CoinsHistoryWatcher $coinsHistoryWatcher, AvailableExchangesHistoryWatcher $exchangeHistoryWatcher)
    {
        $this->coinsWatcher = $coinsHistoryWatcher;
        $this->exchangeHistoryWatcher = $exchangeHistoryWatcher;
    }

    public function tick()
    {
        $this->coinsWatcher->syncHistory();

        $this->exchangeHistoryWatcher->syncHistory();

    }

}