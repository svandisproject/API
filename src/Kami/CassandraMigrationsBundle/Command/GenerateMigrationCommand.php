<?php


namespace Kami\CassandraMigrationsBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class GenerateMigrationCommand extends Command
{
    const TEMPLATE = <<<'EOD'
<?php

namespace CassandraMigrations;
    
use Kami\CassandraMigrationsBundle\AbstractMigration;
use M6Web\Bundle\CassandraBundle\Cassandra\Client;

class CassandraMigration%s extends AbstractMigration
{
    public function migrate(Client $client) : void    
    {
        // Define your migrations here
    }
    
    public function getVersion() : string
    {
        return '%s';
    }
}

EOD;

    private $migrationsDir;

    public function __construct(string $migrationsDir)
    {
        $this->migrationsDir = $migrationsDir;
        parent::__construct();
    }


    public function configure()
    {
        $this
            ->setName('kami:cassandra-migrations:new')
            ->setDescription('Generate new migration class for Cassandra database')
            ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $fs = new Filesystem();
        if (!$fs->exists($this->migrationsDir)) {
            $fs->mkdir($this->migrationsDir);
        }

        $currentTime = (new \DateTime())->getTimestamp();
        $filename = sprintf('%s/CassandraMigration%s.php', $this->migrationsDir, $currentTime);
        $fs->dumpFile($filename, sprintf(self::TEMPLATE, $currentTime, $currentTime));

        $output->writeln(sprintf('Successfully generated new migration: %s', $filename));
    }
}