<?php


namespace Kami\AssetBundle\Tests\Controller;


use Kami\Util\TestCase\ApiTestCase;

class VolumeControllerTest extends ApiTestCase
{
    public function testIndexLoggedInAsAnonymous()
    {
        $response = $this->request('GET', '/api/volume');
        $this->assertJsonResponse($response, 403);
    }

    public function testIndexLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/volume');
        $this->assertJsonResponse($response, 200);
    }

    public function testIndexLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/volume');
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsAnonymous()
    {
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "exchange", "value": "test"}]'));
        $response = $this->request('GET', '/api/volume/filter?filter=' . $filter);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsAnonymous()
    {
        $response = $this->request('POST', '/api/volume', [
            'volume' => [
                'volume_usd' => '1',
                'added_time' =>  time(),
                'exchange' => 'test'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('POST', '/api/volume', [
            'volume' => [
                'volume_usd' => '1',
                'added_time' =>  time(),
                'exchange' => 'test'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/volume', [
            'volume' => [
                'volume_usd' => 1.0,
                'added_time' =>  time(),
                'exchange' => 'test'
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertEquals('test', $this->getResponseData($response)['exchange']);
        $this->assertContainsKeys($response);
    }

    public function testCreateByWorker()
    {
        $response = $this->requestByWorker('POST', '/api/volume', [
            'volume' => [
                'volume_usd' => 1.0,
                'added_time' =>  time(),
                'exchange' => 'test'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testFilterLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "exchange", "value": "test"}]'));
        $response = $this->request('GET', '/api/volume/filter?filter=' . $filter);
        $this->assertEquals('test', $this->getResponseData($response)['content'][0]['exchange']);
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsUser()
    {
        $this->logInAsUser();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "exchange", "value": "test"}]'));
        $response = $this->request('GET', '/api/volume/filter?filter=' . $filter);
        $this->assertEquals('test', $this->getResponseData($response)['content'][0]['exchange']);
        $this->assertJsonResponse($response, 200);
    }

    public function testUpdateLoggedInAsAnonymous()
    {
        $response = $this->request('PUT', '/api/volume/1', [
            'volume' => [
                'volume_usd' => 2.0,
                'added_time' =>  time(),
                'exchange' => 'test'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testUpdateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('PUT', '/api/volume/1', [
            'volume' => [
                'volume_usd' => 2.0,
                'added_time' =>  time(),
                'exchange' => 'test'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testUpdateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/volume/1', [
            'volume' => [
                'volume_usd' => 2.0,
                'added_time' =>  time(),
                'exchange' => 'test'
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertContainsKeys($response);
        $this->assertEquals(2.0, $this->getResponseData($response)['volume_usd']);
    }

    public function testUpdateNotExistedFieldLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/volume/1', [
            'volume' => [
                'volume_usd' => 2.0,
                'added_time' =>  time(),
                'exchang' => 'test'
        ]]);
        $this->assertJsonResponse($response, 400);
    }

    public function testDeleteLoggedInAsAnonymous()
    {
        $response = $this->request('DELETE', '/api/volume/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeletePostLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('DELETE', '/api/volume/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeletePostLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('DELETE', '/api/volume/1');
        $this->assertEquals(204, $response->getStatusCode());
    }

    public function getModelKeys()
    {
        return ['volume_usd', 'added_time', 'exchange'];
    }

}