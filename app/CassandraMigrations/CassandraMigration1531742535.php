<?php

namespace CassandraMigrations;

use Kami\CassandraMigrationsBundle\AbstractMigration;
use M6Web\Bundle\CassandraBundle\Cassandra\Client;
class CassandraMigration1531742535 extends AbstractMigration
{
    public function migrate(Client $client) : void
    {
        $statement = $client->prepare(
            'CREATE TABLE if NOT EXISTS svandis_asset_prices.average_price 
                    ( price float, ticker text, time timestamp, volume float, PRIMARY KEY (ticker, time) )
                    with clustering order by (time desc);'
        );
        $client->execute($statement);
    }

    public function getVersion() : string
    {
        return '1531742535';
    }
}
