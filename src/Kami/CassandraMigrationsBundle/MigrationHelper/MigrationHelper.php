<?php


namespace Kami\CassandraMigrationsBundle\MigrationHelper;


use Kami\CassandraMigrationsBundle\AbstractMigration;
use M6Web\Bundle\CassandraBundle\Cassandra\Client;
use Symfony\Component\Filesystem\Filesystem;

class MigrationHelper
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $migrationDir;

    public function __construct(Client $client, string $migrationDir)
    {
        $this->client = $client;
        $this->migrationDir = $migrationDir;
    }

    public function migrate()
    {
        $this->createMigrationKeyspace();
        $this->createMigrationsTable();
        $executed = $this->getExecutedVersions();

        foreach ($this->getAvailableMigrations() as $migration) {
            if (!in_array($migration->getVersion(), $executed)) {
               $migration->migrate($this->client);
               $this->storeExecutedMigration($migration->getVersion());
            }
        }
    }

    private function getExecutedVersions() : array
    {
        $statement = $this->client->prepare('SELECT version FROM kami_migrations.migrations');
        $results = $this->client->execute($statement);
        $versions = [];
        foreach ($results as $result) {
            $versions[] = $result['version'];
        }

        return $versions;
    }

    private function getAvailableMigrations() : array
    {
        $files = array_diff(scandir($this->migrationDir), ['..', '.']);
        $migrations = [];
        foreach ($files as $file) {
            $class = 'CassandraMigrations\\'.rtrim($file, '.php');
            $migration = new $class;
            if (!$migration instanceof AbstractMigration) {
                throw new \RuntimeException('Migrations should extend AbstractMigration');
            }
            $migrations[] = $migration;
        }

        return $migrations;
    }

    private function storeExecutedMigration($version)
    {
        $statement = $this->client->prepare('INSERT INTO kami_migrations.migrations (id, version) VALUES (?, ?)');
        $this->client->execute($statement, ['arguments' => [
            'id' => new \Cassandra\Uuid(),
            'version' => $version
        ]]);

    }

    private function createMigrationsTable()
    {
        $statement = $this->client->prepare(
            'CREATE TABLE IF NOT EXISTS kami_migrations.migrations(id UUID PRIMARY KEY, version text);'
        );

        $this->client->execute($statement);
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