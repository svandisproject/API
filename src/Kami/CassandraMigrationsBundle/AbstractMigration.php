<?php


namespace Kami\CassandraMigrationsBundle;


use M6Web\Bundle\CassandraBundle\Cassandra\Client;

abstract class AbstractMigration
{
    abstract public function migrate(Client $client) : void;

    abstract public function getVersion() : string;
}