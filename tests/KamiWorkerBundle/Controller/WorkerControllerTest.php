<?php

namespace Kami\WorkerBundle\Tests\Controller;

use Kami\Util\TestCase\ApiTestCase;

class WorkerControllerTest extends ApiTestCase
{
    public function testRegisterWithCorrectToken()
    {
        $response = $this->request('POST', '/worker/register', ['secret' => '1234567890123456']);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('token', $this->getResponseData($response));
        $this->assertEquals(128, strlen($this->getResponseData($response)['token']));
    }

    public function testRegisterWithIncorrectToken()
    {
        $response = $this->request('POST', '/worker/register', ['secret' => 'incorrect']);

        $this->assertEquals(403, $response->getStatusCode());
    }

    public function testScheduleAction()
    {
        $client = static::createClient();
        $client->request('GET', '/api/schedule', [], [], ['HTTP_X-SOCKET-SERVER-TOKEN'=>'test']);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testScheduleActionWithoutCredentials()
    {
        $response = $this->request('GET', '/api/schedule');

        $this->assertEquals(401, $response->getStatusCode());
    }

    public function testHeartbeatNotAuth()
    {
        $response = $this->request('POST', '/worker/heartbeat');

        $this->assertEquals(401, $response->getStatusCode());
    }

    public function testHeartbeatAuth()
    {
        $response = $this->requestByWorker('POST', '/worker/heartbeat');

        $this->assertEquals(204, $response->getStatusCode());
    }

    public function testGetWorkerSecretAuth()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/settings/worker/secret');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('secret', json_decode($response->getContent(), true));
        $this->assertEquals(16, strlen($this->getResponseData($response)['secret']));
    }

    public function testAuthenticateForSocketActionWithCorrectSecret()
    {
        $response = $this->request('POST', '/worker/authenticate', ['secret' => 111]);

        $this->assertArrayHasKey('host', json_decode($response->getContent(), true));
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testRegenerateWorkerCodeAction()
    {
        $this->logInAsUser();
        $response = $this->request('POST', '/api/settings/worker/regenerate-user-token');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('secret', json_decode($response->getContent(), true));
        $this->assertEquals(16, strlen($this->getResponseData($response)['secret']));
    }

    public function getModelKeys()
    {
        return [];
    }
}
