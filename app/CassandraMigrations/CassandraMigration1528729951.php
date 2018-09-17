<?php

namespace CassandraMigrations;
    
use Kami\CassandraMigrationsBundle\AbstractMigration;
use M6Web\Bundle\CassandraBundle\Cassandra\Client;

class CassandraMigration1528729951 extends AbstractMigration
{
    public function migrate(Client $client) : void    
    {
        $statement = $client->prepare(
            'CREATE KEYSPACE IF NOT EXISTS svandis_asset_prices
             WITH REPLICATION = { 
                  \'class\' : \'NetworkTopologyStrategy\', 
                  \'EU_WEST_1\' : 3
               }'
        );
        $client->execute($statement);
    }
    
    public function getVersion() : string
    {
        return '1528729951';
    }
}
