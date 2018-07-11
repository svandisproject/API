<?php

namespace CassandraMigrations;
    
use Kami\CassandraMigrationsBundle\AbstractMigration;
use M6Web\Bundle\CassandraBundle\Cassandra\Client;

class CassandraMigration1531310705 extends AbstractMigration
{
    public function migrate(Client $client) : void    
    {
        $statement = $client->prepare(
            'ALTER TABLE svandis_asset_prices.asset_price ADD
                (exchange varchar)'
        );
        $client->execute($statement);
    }
    
    public function getVersion() : string
    {
        return '1531310705';
    }
}
