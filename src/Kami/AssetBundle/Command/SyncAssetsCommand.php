<?php


namespace Kami\AssetBundle\Command;

use Kami\StockBundle\Watcher\Watcher;
use Pusher\Pusher;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SyncAssetsCommand extends Command
{

    /**
     * @var Watcher
     */
    private $stockWatcher;

    /**
     * @var Pusher
     */
    private $pusher;

    /**
     * @var bool
     */
    private $emergency = false;

    public function __construct(Watcher $watcher, Pusher $pusher){

        $this->stockWatcher = $watcher;
        $this->pusher = $pusher;

        parent::__construct();
    }

    public function configure()
    {
        $this->setName('svandis:assets:sync');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \Exception
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        while (!$this->emergency) {

            $this->stockWatcher->tick();

            sleep(1);
        }
    }
}