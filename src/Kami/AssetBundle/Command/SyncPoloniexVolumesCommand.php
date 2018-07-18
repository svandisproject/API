<?php


namespace Kami\AssetBundle\Command;

use Symfony\Component\Console\Command\Command;
use Kami\StockBundle\Watcher\Poloniex\PoloniexVolumeWatcher;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SyncPoloniexVolumesCommand extends Command
{

    /**
     * @var bool
     */
    private $emergency = false;

    /**
     * @var PoloniexVolumeWatcher $volumeWatcher
     */
    private $poloniexVolumeWatcher;

    public function __construct(PoloniexVolumeWatcher $volumeWatcher){

        $this->poloniexVolumeWatcher = $volumeWatcher;

        parent::__construct();
    }

    public function configure()
    {
        $this->setName('svandis:poloniex.volumes:sync');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        while (!$this->emergency) {
            $this->poloniexVolumeWatcher->updateVolumes();
        }
    }

}