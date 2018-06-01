<?php

namespace Kami\WorkerBundle\Controller;

use Kami\Util\TestCase\ApiTestCase;

class TwitterFeedTest extends ApiTestCase
{
    public function testIndexLoggedInAsAnonymous()
    {
        $response = $this->request('GET', '/api/twitter-feed');
        $this->assertJsonResponse($response, 403);
    }

    public function testIndexLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/twitter-feed');
        $this->assertJsonResponse($response, 200);
    }

    public function testIndexLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/twitter-feed');
        $this->assertJsonResponse($response, 403);
    }

    public function testFilterLoggedInAsAnonymous()
    {
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "username", "value": "@VitalikButerin"}]'));
        $response = $this->request('GET', '/api/twitter-feed/filter?filter=' . $filter);
        $this->assertJsonResponse($response, 403);
    }

    public function testFilterLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "username", "value": "@VitalikButerin"}]'));
        $response = $this->request('GET', '/api/twitter-feed/filter?filter=' . $filter);
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsUser()
    {
        $this->logInAsUser();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "username", "value": "@VitalikButerin"}]'));
        $response = $this->request('GET', '/api/twitter-feed/filter?filter=' . $filter);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsAnonymous()
    {
        $response = $this->request('POST', '/api/twitter-feed', [
            'twitter_feed' => [
                'username' => 'test',
                'consumer_key' => 'test',
                'consumer_secret' => 'test',
                'access_token_key' => 'test',
                'access_token_secret' => 'test',
                'time_interval' => 10000,
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('POST', '/api/twitter-feed', [
            'twitter_feed' => [
                'username' => 'test',
                'consumer_key' => 'test',
                'consumer_secret' => 'test',
                'access_token_key' => 'test',
                'access_token_secret' => 'test',
                'time_interval' => 10000,
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/twitter-feed', [
            'twitter_feed' => [
                'username' => 'test',
                'consumer_key' => 'test',
                'consumer_secret' => 'test',
                'access_token_key' => 'test',
                'access_token_secret' => 'test',
                'time_interval' => 10000,
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertEquals('test', $this->getResponseData($response)['username']);
        $this->assertContainsKeys($response);
    }

    public function testCreateNotExistedFieldLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/twitter-feed', [
            'twitter_feed' => [
                'test' => 'test'
            ]
        ]);
        $this->assertJsonResponse($response, 400);
    }

    public function testSingleLoggedInAsAnonymous()
    {
        $response = $this->request('GET', '/api/twitter-feed/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testSingleLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/twitter-feed/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testSingleLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/twitter-feed/1');
        $this->assertJsonResponse($response, 200);
        $this->assertContainsKeys($response);
    }

    public function testSingleNotExistedIdLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/twitter-feed/0');
        $this->assertJsonResponse($response, 404);
    }

    public function testEditLoggedInAsAnonymous()
    {
        $response = $this->request('PUT', '/api/twitter-feed/1', [
            'twitter_feed' => [
                'username' => 'edited'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testEditLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('PUT', '/api/twitter-feed/1', [
            'twitter_feed' => [
                'username' => 'edited'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testEditLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/twitter-feed/1', [
            'twitter_feed' => [
                'username' => 'edited',
                'consumer_key' => 'edited',
                'consumer_secret' => 'edited',
                'access_token_key' => 'edited',
                'access_token_secret' => 'edited',
                'time_interval' => 1000,
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertContainsKeys($response);
        $this->assertEquals('edited', $this->getResponseData($response)['username']);
        $this->assertEquals('edited', $this->getResponseData($response)['consumer_key']);
        $this->assertEquals('edited', $this->getResponseData($response)['consumer_secret']);
        $this->assertEquals('edited', $this->getResponseData($response)['access_token_key']);
        $this->assertEquals('edited', $this->getResponseData($response)['access_token_secret']);
        $this->assertEquals(1000, $this->getResponseData($response)['time_interval']);
    }

    public function testDeleteLoggedInAsAnonymous()
    {
        $response = $this->request('DELETE', '/api/twitter-feed/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeleteLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('DELETE', '/api/twitter-feed/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeleteLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('DELETE', '/api/twitter-feed/1');
        $this->assertEquals(204, $response->getStatusCode());
    }



    public function getModelKeys()
    {
        return ['consumer_key', 'consumer_secret', 'access_token_key', 'access_token_secret', 'time_interval'];
    }
}