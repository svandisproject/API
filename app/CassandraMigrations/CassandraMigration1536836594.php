<?php

namespace CassandraMigrations;
    
use Kami\CassandraMigrationsBundle\AbstractMigration;
use M6Web\Bundle\CassandraBundle\Cassandra\Client;

class CassandraMigration1536836594 extends AbstractMigration
{
    public function migrate(Client $client) : void    
    {
        $statement = $client->prepare(
            'CREATE TABLE if NOT EXISTS svandis_url_cache.logs 
                    ( task_type text, user_id DECIMAL, time timestamp, log text, PRIMARY KEY ((user_id, task_type), time));'
        );
        $client->execute($statement);
    }
    
    public function getVersion() : string
    {
        return '1536836594';
    }
}
