<?php


namespace Kami\IcoBundle\Tests;


use Kami\Util\TestCase\ApiTestCase;

class SocialMediaTest extends ApiTestCase
{
    public function testIndexLoggedInAsAnonymous()
    {
        $response = $this->request('GET', '/api/social-media');
        $this->assertJsonResponse($response, 200);
    }

    public function testIndexLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/social-media');
        $this->assertJsonResponse($response, 200);
    }

    public function testIndexLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/social-media');
        $this->assertJsonResponse($response, 200);
    }

    public function testCreateLoggedInAsAnonymous()
    {
        $response = $this->request('POST', '/api/social-media', [
            'social_media' => [
                'twitter_followers' => 1,
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('POST', '/api/social-media', [
            'social_media' => [
                'twitter_followers' => 1
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/social-media', [
            'social_media' => [
                'twitter_followers' => 1
            ]
        ]);

        $this->assertJsonResponse($response, 200);
        $this->assertEquals(1, $this->getResponseData($response)['twitter_followers']);
        $this->assertContainsKeys($response);
    }

    public function testCreateByWorker()
    {
        $response = $this->requestByWorker('POST', '/api/social-media', [
            'social_media' => [
                'twitter_followers' => 1,
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testFilterLoggedInAsAnonymous()
    {
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "twitterFollowers", "value": 1}]'));
        $response = $this->request('GET', '/api/social-media/filter?filter=' . $filter);
        $this->assertEquals(1, $this->getResponseData($response)['content'][0]['twitter_followers']);
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "twitterFollowers", "value": 1}]'));
        $response = $this->request('GET', '/api/social-media/filter?filter=' . $filter);
        $this->assertEquals(1, $this->getResponseData($response)['content'][0]['twitter_followers']);
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsUser()
    {
        $this->logInAsUser();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "twitterFollowers", "value": 1}]'));
        $response = $this->request('GET', '/api/social-media/filter?filter=' . $filter);
        $this->assertEquals(1, $this->getResponseData($response)['content'][0]['twitter_followers']);
        $this->assertJsonResponse($response, 200);
    }

    public function testUpdateLoggedInAsAnonymous()
    {
        $response = $this->request('PUT', '/api/social-media/1', [
            'social_media' => [
                'twitter_followers' => 2
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testUpdateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('PUT', '/api/social-media/1', [
            'social_media' => [
                'twitter_followers' => 2
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testUpdateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/social-media/1', [
            'social_media' => [
                'twitter_followers' => 2
            ]
        ]);

        $this->assertJsonResponse($response, 200);
        $this->assertEquals(2, $this->getResponseData($response)['twitter_followers']);
    }

    public function testUpdateNotExistedFieldLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/social-media/1', [
            'social_media' => [
                'native_blockchain' => 2
            ]
        ]);
        $this->assertJsonResponse($response, 400);
    }

    public function testDeleteLoggedInAsAnonymous()
    {
        $response = $this->request('DELETE', '/api/social-media/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeleteLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('DELETE', '/api/social-media/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeleteLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('DELETE', '/api/social-media/1');
        $this->assertEquals(204, $response->getStatusCode());
    }

    public function getModelKeys()
    {
        return ['twitter_followers'];
    }
}