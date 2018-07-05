<?php


namespace Kami\AssetBundle\Command;

use Kami\StockBundle\Watcher\CoinMarketCap\CoinMarketCapWatcher;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SyncMarketCapCommand extends Command
{

    /**
     * @var CoinMarketCapWatcher
     */
    private $coinMarketWatcher;

    public function __construct(CoinMarketCapWatcher $coinMarketCapWatcher){
        $this->coinMarketWatcher = $coinMarketCapWatcher;
        parent::__construct();
    }

    public function configure()
    {
        $this->setName('svandis:coin-market:sync');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     * @throws \Cassandra\Exception
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->coinMarketWatcher->sync();
        sleep(1);
    }
}