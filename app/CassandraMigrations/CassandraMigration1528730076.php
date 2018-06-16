<?php

namespace CassandraMigrations;
    
use Kami\CassandraMigrationsBundle\AbstractMigration;
use M6Web\Bundle\CassandraBundle\Cassandra\Client;

class CassandraMigration1528730076 extends AbstractMigration
{
    public function migrate(Client $client) : void    
    {
        $statement = $client->prepare(
            'CREATE TABLE IF NOT EXISTS svandis_asset_prices.asset_price 
                 (id UUID PRIMARY KEY, time timestamp, ticker varchar, price int)'
        );
        $client->execute($statement);
    }
    
    public function getVersion() : string
    {
        return '1528730076';
    }
}
