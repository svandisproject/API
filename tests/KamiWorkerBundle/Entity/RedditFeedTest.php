<?php

namespace Kami\WorkerBundle\Tests\Entity;

use Kami\Util\TestCase\ApiTestCase;

class RedditFeedTest extends ApiTestCase
{

    public function testIndexLoggedInAsAnonymous()
    {
        $response = $this->request('GET', '/api/reddit-feed');
        $this->assertJsonResponse($response, 403);
    }

    public function testIndexLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/reddit-feed');
        $this->assertJsonResponse($response, 403);
    }

    public function testIndexLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/reddit-feed');
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsAnonymous()
    {
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "clientId", "value": "test1234"}]'));
        $response = $this->request('GET', '/api/reddit-feed/filter?filter=' . $filter);
        $this->assertJsonResponse($response, 403);
    }

    public function testFilterLoggedInAsUser()
    {
        $this->logInAsUser();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "clientId", "value": "test1234"}]'));
        $response = $this->request('GET', '/api/reddit-feed/filter?filter=' . $filter);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsAnonymous()
    {
        $response = $this->request('POST', '/api/reddit-feed', [
            'reddit_feed' => [
                'client_id' => 'test1234',
                'client_secret' => 'test123',
                'username' => 'test',
                'password' => 'test',
                'time_interval' => 1000
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsUser()
    {
        $this->logInAsUser();

        $response = $this->request('POST',  '/api/reddit-feed', [
            'reddit_feed' => [
                'client_id' => 'test1234',
                'client_secret' => 'test123',
                'username' => 'test',
                'password' => 'test',
                'time_interval' => 1000
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }


        public function testCreateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/reddit-feed', [
            'reddit_feed' => [
                'client_id' => 'test1234',
                'client_secret' => 'test123',
                'username' => 'test',
                'password' => 'test',
                'time_interval' => 1000
            ]
        ]);

        $this->assertJsonResponse($response, 200);
        $this->assertEquals('test1234', $this->getResponseData($response)['client_id']);
        $this->assertContainsKeys($response);
    }

    public function testFilterLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "clientId", "value": "test1234"}]'));
        $response = $this->request('GET', '/api/reddit-feed/filter?filter=' . $filter);
        $this->assertJsonResponse($response, 200);
    }

    public function testCreateLoggedInAsAdminWithNotUniqueClientId()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/reddit-feed', [
            'reddit_feed' => [
                'client_id' => 'test1234',
                'client_secret' => 'test123',
                'username' => 'test',
                'password' => 'test',
                'time_interval' => 1000
            ]
        ]);
        $this->assertJsonResponse($response, 400);
    }

    public function testEditLoggedInAsAnonymous()
    {
        $response = $this->request('PUT', '/api/reddit-feed/1', [
            'reddit_feed' => [
                'client_id' => 'test1235',
                'client_secret' => 'test124',
                'username' => 'test',
                'password' => 'test',
                'time_interval' => 100
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testEditLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('PUT', '/api/reddit-feed/1', [
            'reddit_feed' => [
                'client_id' => 'test1235',
                'client_secret' => 'test124',
                'username' => 'test',
                'password' => 'test',
                'time_interval' => 100
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testEditLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/reddit-feed/1', [
            'reddit_feed' => [
                'client_id' => 'test1235',
                'client_secret' => 'test124',
                'username' => 'test',
                'password' => 'test',
                'time_interval' => 100
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertContainsKeys($response);
        $this->assertEquals('test1235', $this->getResponseData($response)['client_id']);
    }

    public function testEditNotExistedFieldLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/reddit-feed/1', ['reddit_feed' => ['name' => 'edit']]);
        $this->assertJsonResponse($response, 400);
    }

    public function testDeleteLoggedInAsAnonymous()
    {
        $response = $this->request('DELETE', '/api/reddit-feed/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeleteLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('DELETE', '/api/reddit-feed/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeleteLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('DELETE', '/api/reddit-feed/1');
        $this->assertEquals(204, $response->getStatusCode());
    }

    public function getModelKeys()
    {
        return [ 'client_id', 'client_secret', 'username', 'password', 'time_interval'];
    }

}