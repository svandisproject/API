<?php

namespace Kami\WorkerBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WorkerControllerTest extends WebTestCase
{
    public function testRegisterWithCorrectToken()
    {
        $client = static::createClient();
        $client->request('POST', '/worker/register', ['secret' => '1234567890123456']);
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('token', json_decode($response->getContent(), true));
        $this->assertEquals(128, strlen(json_decode($response->getContent())->token));
    }

    public function testRegisterWithIncorrectToken()
    {
        $client = static::createClient();
        $client->request('POST', '/worker/register', ['secret' => 'incorrect']);
        $response = $client->getResponse();
        $this->assertEquals(403, $response->getStatusCode());
    }

    public function testScheduleAction()
    {
        $client = static::createClient();
        $client->request('GET', '/api/schedule', [], [], ['HTTP_X-SOCKET-SERVER-TOKEN'=>'test']);
        $response = $client->getResponse();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testScheduleActionWithoutCredentials()
    {
        $client = static::createClient();
        $client->request('GET', '/api/schedule');
        $response = $client->getResponse();

        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }
}
