<?php


namespace Kami\AssetBundle\Command;

use Symfony\Component\Console\Command\Command;
use Kami\StockBundle\Watcher\Bittrex\BittrexVolumeWatcher;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SyncBittrexVolumesCommand extends Command
{
    /**
     * @var bool
     */
    private $emergency = false;

    /**
     * @var BittrexVolumeWatcher $volumeWatcher
     */
    private $bittrexVolumeWatcher;

    public function __construct(BittrexVolumeWatcher $volumeWatcher){

        $this->bittrexVolumeWatcher = $volumeWatcher;

        parent::__construct();
    }

    public function configure()
    {
        $this->setName('svandis:bittrex.volumes:sync');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        while (!$this->emergency) {
            $this->bittrexVolumeWatcher->updateVolumes();
        }
    }

}