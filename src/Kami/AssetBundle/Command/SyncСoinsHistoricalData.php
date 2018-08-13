<?php


namespace Kami\AssetBundle\Command;


use Pusher\Pusher;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Kami\StockBundle\Watcher\History\HistoryWatcher;

class SyncСoinsHistoricalData extends Command
{
    /**
     * @var HistoryWatcher
     */
    private $historyWatcher;

    /**
     * @var Pusher
     */
    private $pusher;

    public function __construct(HistoryWatcher $watcher, Pusher $pusher){

        $this->historyWatcher = $watcher;
        $this->pusher = $pusher;

        parent::__construct();
    }

    public function configure()
    {
        $this->setName('svandis:assets_history:sync');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
            $this->historyWatcher->tick();
    }

}