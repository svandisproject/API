<?php


namespace Kami\CassandraMigrationsBundle\Command;


use Kami\CassandraMigrationsBundle\MigrationHelper\MigrationHelper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateCommand extends Command
{
    /**
     * @var MigrationHelper
     */
    private $migrationHelper;

    public function __construct(MigrationHelper $migrationHelper)
    {
        $this->migrationHelper = $migrationHelper;
        parent::__construct();
    }

    public function configure()
    {
        $this->setName('kami:cassandra-migrations:migrate')
            ->setDescription('Execute Cassandra migrations')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->migrationHelper->migrate();
    }
}