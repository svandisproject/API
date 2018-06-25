<?php


namespace Kami\AssetBundle\Command;

use Doctrine\ORM\EntityManager;
use Kami\StockBundle\Watcher\Watcher;
use M6Web\Bundle\CassandraBundle\Cassandra\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SyncAssetsCommand extends Command
{
    /**
     * @var Client
     */
    private $cassandra;

    /**
     * @var EntityManager
     */
    private $doctrine;

    /**
     * @var Watcher
     */
    private $stockWatcher;

    /**
     * @var
     */
    private $pusher;

    /**
     * @var bool
     */
    private $emergency = false;

    public function __construct(Client $client, EntityManager $entityManager, Watcher $watcher){

        $this->cassandra = $client;
        $this->doctrine = $entityManager;
        $this->stockWatcher = $watcher;

        parent::__construct();
    }

    public function configure()
    {
        $this->setName('svandis:assets:sync');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        while (!$this->emergency) {

            $this->stockWatcher->execute($this->cassandra, $this->doctrine);

            sleep(1);
        }
    }
}