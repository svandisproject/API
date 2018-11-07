<?php


namespace Kami\WorkerBundle\StatisticUpdater;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateStatisticCommand extends Command
{
    /**
     * @var EntityManager
     */
    private $manager;

    /**
     * @var bool
     */
    private $emergency = false;

    public function __construct(EntityManager $manager){

        $this->manager = $manager;

        parent::__construct();
    }

    public function configure()
    {
        $this->setName('svandis:statistic:update');
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
        while (!$this->emergency) {

            $this->manager->getRepository(Post::class);

            dump(1);

//            sleep(1);
        }
    }
}