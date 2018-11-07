<?php


namespace Kami\IcoBundle\Tests;


use Kami\Util\TestCase\ApiTestCase;

class DevelopmentTest extends ApiTestCase
{

    public function testIndexLoggedInAsAnonymous()
    {
        $response = $this->request('GET', '/api/development');
        $this->assertJsonResponse($response, 403);
    }

    public function testIndexLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/development');
        $this->assertJsonResponse($response, 200);
    }

    public function testIndexLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/development');
        $this->assertJsonResponse($response, 200);
    }

    public function testCreateLoggedInAsAnonymous()
    {
        $response = $this->request('POST', '/api/development', [
            'development' => [
                'native_blockchain' => true,
                'whitepaper_link' => 'test',
                'testnet_date' => '2018-11-11 00:00:10'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('POST', '/api/development', [
            'development' => [
                'native_blockchain' => true,
                'whitepaper_link' => 'test',
                'testnet_date' => '2018-11-11 00:00:10'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/development', [
            'development' => [
                'native_blockchain' => true,
                'whitepaper_link' => 'test',
                'testnet_date' => '2018-11-11 00:00:10'
            ]
        ]);

        $this->assertJsonResponse($response, 200);
        $this->assertEquals("test", $this->getResponseData($response)['whitepaper_link']);
        $this->assertContainsKeys($response);
    }

    public function testCreateByWorker()
    {
        $response = $this->requestByWorker('POST', '/api/development', [
            'development' => [
                'native_blockchain' => true,
                'whitepaper_link' => 'test',
                'testnet_date' => '2018-11-11 00:00:10'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testFilterLoggedInAsAnonymous()
    {
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "whitepaper_link", "value": "test"}]'));
        $response = $this->request('GET', '/api/development/filter?filter=' . $filter);

        $this->assertJsonResponse($response, 403);
    }

    public function testFilterLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "whitepaperLink", "value": "test"}]'));
        $response = $this->request('GET', '/api/development/filter?filter=' . $filter);
        $this->assertEquals("test", $this->getResponseData($response)['content'][0]['whitepaper_link']);
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsUser()
    {
        $this->logInAsUser();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "whitepaperLink", "value": "test"}]'));
        $response = $this->request('GET', '/api/development/filter?filter=' . $filter);
        $this->assertEquals("test", $this->getResponseData($response)['content'][0]['whitepaper_link']);
        $this->assertJsonResponse($response, 200);
    }

    public function testUpdateLoggedInAsAnonymous()
    {
        $response = $this->request('PUT', '/api/development/1', [
            'development' => [
                'whitepaper_link' => 'test2'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testUpdateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('PUT', '/api/development/1', [
            'development' => [
                'whitepaper_link' => 'test2'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testUpdateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/development/1', [
            'development' => [
                'whitepaper_link' => 'test2'
            ]
        ]);

        $this->assertJsonResponse($response, 200);
        $this->assertEquals("test2", $this->getResponseData($response)['whitepaper_link']);
    }

    public function testUpdateNotExistedFieldLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/development/1', [
            'development' => [
                'native_blockchain' => true,
                'whitepaper_link' => 'test',
                'testnet_dat' => '2018-11-11 00:00:10'
            ]
        ]);
        $this->assertJsonResponse($response, 400);
    }

    public function testDeleteLoggedInAsAnonymous()
    {
        $response = $this->request('DELETE', '/api/development/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeleteLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('DELETE', '/api/development/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeleteLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('DELETE', '/api/development/1');
        $this->assertEquals(204, $response->getStatusCode());
    }

    public function getModelKeys()
    {
       return ['native_blockchain', 'whitepaper_link', 'testnet_date'];
    }

}