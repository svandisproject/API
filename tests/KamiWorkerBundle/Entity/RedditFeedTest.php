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
        $response = $this->request('GET', '/api/reddit-feed/filter');
        $this->assertJsonResponse($response, 403);
    }

    public function testFilterLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/reddit-feed/filter');
        $this->assertJsonResponse($response, 403);
    }

    public function testFilterLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/reddit-feed/filter');
        $this->assertJsonResponse($response, 200);
    }

    public function testCreateLoggedInAsAnonymous()
    {
        $response = $this->request('POST', '/api/reddit-feed', [
            'reddit_feed' => [
                'clientId' => 'test1234',
                'clientSecret' => 'test123',
                'username' => 'test',
                'password' => 'test',
                'timeInterval' => 1000
            ]]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsUser()
    {
        $this->logInAsUser();

        $response = $this->request('POST',  '/api/reddit-feed',
            [
                'reddit_feed' => [
                    'clientId' => 'test1234',
                    'clientSecret' => 'test123',
                    'username' => 'test',
                    'password' => 'test',
                    'timeInterval' => 1000
                ]]);
        $this->assertJsonResponse($response, 403);
    }


        public function testCreateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/reddit-feed', [
            'reddit_feed' => [
            'clientId' => 'test1234',
            'clientSecret' => 'test123',
            'username' => 'test',
            'password' => 'test',
            'timeInterval' => 1000
        ]]);
        $this->assertJsonResponse($response, 200);
        $this->assertEquals('test1234', $this->getResponseData($response)['client_id']);
        $this->assertContainsKeys($response);
    }

    public function testCreateLoggedInAsAdminWithNotUniqueClientId()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/reddit-feed', [
            'reddit_feed' => [
                'clientId' => 'test1234',
                'clientSecret' => 'test123',
                'username' => 'test',
                'password' => 'test',
                'timeInterval' => 1000
            ]]);
        $this->assertJsonResponse($response, 500);
    }

    public function testFilterLimitLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/reddit-feed/filter?limit=1');
        $this->assertJsonResponse($response, 200);
        $response = $this->getResponseData($response);
        $this->assertCount(1, $response['rows']);
    }

    public function testFilterLimitLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/reddit-feed/filter?limit=1');
        $this->assertJsonResponse($response, 403);
    }

    public function testEditLoggedInAsAnonymous()
    {
        $response = $this->request('PUT', '/api/reddit-feed/1', [
            'reddit_feed' => [
                'clientId' => 'test1235',
                'clientSecret' => 'test124',
                'username' => 'test',
                'password' => 'test',
                'timeInterval' => 100
            ]]);
        $this->assertJsonResponse($response, 403);
    }

    public function testEditLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('PUT', '/api/reddit-feed/1', [
            'reddit_feed' => [
                'clientId' => 'test1235',
                'clientSecret' => 'test124',
                'username' => 'test',
                'password' => 'test',
                'timeInterval' => 100
            ]]);
        $this->assertJsonResponse($response, 403);
    }

    public function testEditLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/reddit-feed/1', [
            'reddit_feed' => [
                'clientId' => 'test1235',
                'clientSecret' => 'test124',
                'username' => 'test',
                'password' => 'test',
                'timeInterval' => 100
            ]]);
        $this->assertJsonResponse($response, 200);
        $this->assertContainsKeys($response);
        $this->assertEquals('test1235', $this->getResponseData($response)['client_id']);
    }

    public function testEditNotExistedFieldLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/reddit-feed/1', ['reddit_feed' => ['name' => 'edit']]);
        $this->assertJsonResponse($response, 400);
        $this->assertEquals('This form should not contain extra fields.', $this->getResponseData($response)['form']['errors'][0]);
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
        $this->assertJsonResponse($response, 201);
    }

    public function getModelKeys()
    {
        return [ 'client_id', 'client_secret', 'username', 'password', 'time_interval'];
    }

}