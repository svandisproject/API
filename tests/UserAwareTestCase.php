<?php

namespace Kami\ContentBundle\Tests\AuthTest;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserAwareTestCase extends WebTestCase
{
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
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));

        return $client;
    }
}
