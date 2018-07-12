<?php


namespace Kami\AssetBundle\Command;

use Symfony\Component\Console\Command\Command;
use Kami\StockBundle\Watcher\VolumesWatcher;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SyncAssetsVolumesCommand extends Command
{

    /**
     * @var VolumesWatcher $watcher
     */
    private $volumeWatcher;

    public function __construct(VolumesWatcher $watcher){

        $this->volumeWatcher = $watcher;

        parent::__construct();
    }

    public function configure()
    {
        $this->setName('svandis:volumes:sync');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {

            $this->volumeWatcher->getVolumes();
    }

}