<?php


namespace Kami\AssetBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SyncAssetsCommand extends Command
{
    private $cassandra;

    private $doctrine;

    public function configure()
    {
        $this->setName('svandis:assets:sync');
    }
}