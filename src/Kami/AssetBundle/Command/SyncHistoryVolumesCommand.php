<?php


namespace Kami\AssetBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Kami\StockBundle\Watcher\History\HistoryVolumesWatcher;

class SyncHistoryVolumesCommand extends Command
{

    /**
     * @var HistoryVolumesWatcher
     */
    private $historyVolumesWatcher;

    public function __construct(HistoryVolumesWatcher $volumesWatcher) {

        $this->historyVolumesWatcher = $volumesWatcher;

        parent::__construct();
    }

    public function configure()
    {
        $this->setName('svandis:history_volumes:sync');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->historyVolumesWatcher->tick();
    }

}