<?php

namespace Kami\TestCase;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\BufferedOutput;

class UserAwareTestCase extends WebTestCase
{
    /**
     * @var bool
     */
    protected static $schemaSetup = false;
    /**
     * @var Application
     */
    protected static $application = null;

    protected function setUp()
    {
        if(null == static::$kernel) {
            static::createClient();
        }
        if(false == self::$schemaSetup) {
            static::runCommand('doctrine:schema:drop --force --env=test');
            static::runCommand('doctrine:schema:create --env=test');
            static::$kernel->getContainer()->get('khepin.yaml_loader')->loadFixtures('test');
            static::$schemaSetup = true;
        }
    }

    protected static function runCommand($command)
    {
        if(null == static::$kernel) {
            static::$kernel = static::createKernel();
        }
        if(null == static::$application) {
            static::$application = new Application(static::$kernel);
            static::$application->setAutoExit(false);
        }
        $input = new StringInput($command);
        $output = new BufferedOutput();
        static::$application->run($input, $output);
    }



    public function loginAsAdmin()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/login_check',
            ['username' => 'admin@apimonster.com', 'password' => 'admin']
        );

        $data = json_decode($client->getResponse()->getContent(), true);

        $client = static::createClient();
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));

        return $client;
    }
    public function loginAsUser()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/login_check',
            ['username' => 'user@apimonster.com', 'password' => 'user']
        );

        $data = json_decode($client->getResponse()->getContent(), true);

        $client = static::createClient();
//        dump($data);exit;
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));

        return $client;
    }
}
