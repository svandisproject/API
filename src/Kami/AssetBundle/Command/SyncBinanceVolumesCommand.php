<?php


namespace Kami\AssetBundle\Command;

use Symfony\Component\Console\Command\Command;
use Kami\StockBundle\Watcher\Binance\BinanceVolumeWatcher;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SyncBinanceVolumesCommand extends Command
{

    /**
     * @var bool
     */
    private $emergency = false;

    /**
     * @var BinanceVolumeWatcher $volumeWatcher
     */
    private $binanceVolumeWatcher;

    public function __construct(BinanceVolumeWatcher $volumeWatcher){

        $this->binanceVolumeWatcher = $volumeWatcher;

        parent::__construct();
    }

    public function configure()
    {
        $this->setName('svandis:binance.volumes:sync');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        while (!$this->emergency) {
            $this->binanceVolumeWatcher->updateVolumes();
        }
    }

}