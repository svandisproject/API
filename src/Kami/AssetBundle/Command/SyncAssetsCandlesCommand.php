<?php


namespace Kami\AssetBundle\Command;


use Kami\StockBundle\Watcher\CandlesWatcher;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SyncAssetsCandlesCommand extends Command
{
    /**
     * @var CandlesWatcher
     */
    private $candlesWatcher;

    public function __construct(CandlesWatcher $candlesWatcher){

        $this->candlesWatcher = $candlesWatcher;

        parent::__construct();
    }

    public function configure()
    {
        $this->setName('svandis:assets_candles:sync');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \Cassandra\Exception
     * @throws \Exception
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {

            $this->candlesWatcher->tick();

    }

}