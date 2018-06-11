<?php


namespace Kami\CassandraMigrationsBundle\MigrationHelper;


use M6Web\Bundle\CassandraBundle\Cassandra\Client;
use Symfony\Component\Filesystem\Filesystem;

class MigrationHelper
{
    /**
     * @var Client
     */
    private $client;

    private $migrationDir;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function migrate()
    {
        $this->createMigrationKeyspace();
    }

    private function getAvailableMigrations() : array
    {

    }

    private function createMigrationsTable()
    {
        $this->client->prepare();
    }

    private function createMigrationKeyspace()
    {
        $statement = $this->client->prepare(
            'CREATE  KEYSPACE IF NOT EXISTS kami_migrations 
                  WITH REPLICATION = { 
                  \'class\' : \'SimpleStrategy\', 
                  \'replication_factor\' : 1 
               }'
        );

        $this->client->execute($statement);
    }

}