<?php

namespace CassandraMigrations;
    
use Kami\CassandraMigrationsBundle\AbstractMigration;
use M6Web\Bundle\CassandraBundle\Cassandra\Client;

class CassandraMigration1528724682 extends AbstractMigration
{
    public function migrate(Client $client) : void    
    {
        $statement = $client->prepare(
            'CREATE TABLE IF NOT EXISTS 
             svandis_url_cache.crawled_urls
             (id UUID PRIMARY KEY, url text, confirmations tinyint);'
        );

        $client->execute($statement);
    }
    
    public function getVersion() : string
    {
        return '1528724682';
    }
}
