<?php

namespace Kami\WorkerBundle\Entity;

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
        $response = $this->request('GET', '/api/twitter-feed/filter');
        $this->assertJsonResponse($response, 403);
    }

    public function testFilterLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/twitter-feed/filter');
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/twitter-feed/filter');
        $this->assertJsonResponse($response, 403);
    }

    public function testFilterByExistingParameterLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/twitter-feed/filter?mode=test');
        $this->assertJsonResponse($response, 200);
    }

    public function testCreateLoggedInAsAnonymous()
    {
        $response = $this->request('POST', '/api/twitter-feed',
            [
                'twitter_feed' => [
                    'mode' => 'test',
                    'consumerKey' => 'test',
                    'consumerSecret' => 'test',
                    'accessTokenKey' => 'test',
                    'accessTokenSecret' => 'test',
                    'timeInterval' => 10000,
                ]
            ]
        );
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('POST', '/api/twitter-feed',
            [
                'twitter_feed' => [
                    'mode' => 'test',
                    'consumerKey' => 'test',
                    'consumerSecret' => 'test',
                    'accessTokenKey' => 'test',
                    'accessTokenSecret' => 'test',
                    'timeInterval' => 10000,
                ]
            ]
        );
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/twitter-feed',
            [
                'twitter_feed' => [
                    'mode' => 'test',
                    'consumerKey' => 'test',
                    'consumerSecret' => 'test',
                    'accessTokenKey' => 'test',
                    'accessTokenSecret' => 'test',
                    'timeInterval' => 10000,
                ]
            ]
        );
        $this->assertJsonResponse($response, 200);
        $this->assertEquals('test', $this->getResponseData($response)['mode']);
        $this->assertContainsKeys($response);
    }

    public function testFilterLimitLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/twitter-feed/filter?limit=1');
        $this->assertJsonResponse($response, 200);
        $response = $this->getResponseData($response);
        $this->assertCount(1, $response['rows']);
    }

    public function testCreateNotExistedFieldLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/twitter-feed', [
                'twitter_feed' => [
                    'test' => 'test'
                ]
            ]
        );
        $this->assertJsonResponse($response, 400);
        $this->assertEquals('This form should not contain extra fields.', $this->getResponseData($response)['form']['errors'][0]);
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
        $response = $this->request('PUT', '/api/twitter-feed/1',
            [
                'twitter_feed' => [
                    'mode' => 'edited'
                ]
            ]
        );
        $this->assertJsonResponse($response, 403);
    }

    public function testEditLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('PUT', '/api/twitter-feed/1',
            [
                'twitter_feed' => [
                    'mode' => 'edited'
                ]
            ]
        );
        $this->assertJsonResponse($response, 403);
    }

    public function testEditLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/twitter-feed/1',
            [
                'twitter_feed' => [
                    'mode' => 'edited',
                    'consumerKey' => 'edited',
                    'consumerSecret' => 'edited',
                    'accessTokenKey' => 'edited',
                    'accessTokenSecret' => 'edited',
                    'timeInterval' => 1000,
                ]
            ]
        );
        $this->assertJsonResponse($response, 200);
        $this->assertContainsKeys($response);
        $this->assertEquals('edited', $this->getResponseData($response)['mode']);
        $this->assertEquals('edited', $this->getResponseData($response)['consumer_key']);
        $this->assertEquals('edited', $this->getResponseData($response)['consumer_secret']);
        $this->assertEquals('edited', $this->getResponseData($response)['access_token_key']);
        $this->assertEquals('edited', $this->getResponseData($response)['access_token_secret']);
        $this->assertEquals(1000, $this->getResponseData($response)['time_interval']);
    }

    public function testEditNotExistedFieldLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/twitter-feed/1',
            [
                'twitter_feed' => [
                    'name' => 'edit'
                ]
            ]
        );
        $this->assertJsonResponse($response, 400);
        $this->assertEquals('This form should not contain extra fields.', $this->getResponseData($response)['form']['errors'][0]);
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
        $this->assertJsonResponse($response, 201);
    }



    public function getModelKeys()
    {
        return ['mode', 'consumer_key', 'consumer_secret', 'access_token_key', 'access_token_secret', 'time_interval'];
    }
}