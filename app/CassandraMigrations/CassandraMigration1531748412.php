<?php

namespace CassandraMigrations;
    
use Kami\CassandraMigrationsBundle\AbstractMigration;
use M6Web\Bundle\CassandraBundle\Cassandra\Client;

class CassandraMigration1531748412 extends AbstractMigration
{
    public function migrate(Client $client) : void    
    {
        // Define your migrations here
    }
    
    public function getVersion() : string
    {
        return '1531748412';
    }
}
