<?php


namespace Kami\AssetBundle\Command;

use Symfony\Component\Console\Command\Command;
use Kami\StockBundle\Watcher\Bitfinex\BitfinexVolumeWatcher;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SyncBitfinexVolumesCommand extends Command
{

    /**
     * @var bool
     */
    private $emergency = false;

    /**
     * @var BitfinexVolumeWatcher $volumeWatcher
     */
    private $bitfinexVolumeWatcher;

    public function __construct(BitfinexVolumeWatcher $volumeWatcher){

        $this->bitfinexVolumeWatcher = $volumeWatcher;

        parent::__construct();
    }

    public function configure()
    {
        $this->setName('svandis:bitfinex.volumes:sync');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {

        while (!$this->emergency) {
            $this->bitfinexVolumeWatcher->updateVolumes();
        }
    }

}