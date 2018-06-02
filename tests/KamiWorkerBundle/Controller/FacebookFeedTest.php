<?php

namespace Kami\WorkerBundle\Controller;

use Kami\Util\TestCase\ApiTestCase;

class FacebookFeedTest extends ApiTestCase
{
    public function testIndexLoggedInAsAnonymous()
    {
        $response = $this->request('GET', '/api/facebook-feed');
        $this->assertJsonResponse($response, 403);
    }

    public function testIndexLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/facebook-feed');
        $this->assertJsonResponse($response, 200);
    }

    public function testIndexLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/facebook-feed');
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsAnonymous()
    {
        $response = $this->request('POST', '/api/facebook-feed', [
            'facebook_feed' => [
                'email' => 'test@test.test',
                'password' => 'test',
                'time_interval' => 10000,
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('POST', '/api/facebook-feed', [
            'facebook_feed' => [
                'email' => 'test@test.test',
                'password' => 'test',
                'time_interval' => 10000,
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/facebook-feed', [
            'facebook_feed' => [
                'email' => 'test@test.test',
                'password' => 'test',
                'time_interval' => 10000,
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertEquals('test@test.test', $this->getResponseData($response)['email']);
        $this->assertContainsKeys($response);
    }

    public function testSingleLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/facebook-feed/1');
        $this->assertJsonResponse($response, 200);
        $this->assertContainsKeys($response);
    }

    public function testCreateExistedEmailLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/facebook-feed', [
            'facebook_feed' => [
                'email' => 'test@test.test',
                'password' => 'test',
                'time_interval' => 10000,
            ]
        ]);
        $this->assertJsonResponse($response, 400);
    }

    public function testFilterLoggedInAsAnonymous()
    {
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "email", "value": "test@test.test"}]'));
        $response = $this->request('GET', '/api/facebook-feed/filter?filter=' . $filter);
        $this->assertJsonResponse($response, 403);
    }

    public function testFilterLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "email", "value": "test@test.test"}]'));
        $response = $this->request('GET', '/api/facebook-feed/filter?filter=' . $filter);
        $this->assertEquals('test@test.test', $this->getResponseData($response)['content'][0]['email']);
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsUser()
    {
        $this->logInAsUser();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "email", "value": "test@test.test"}]'));
        $response = $this->request('GET', '/api/facebook-feed/filter?filter=' . $filter);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateNotExistedFieldLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "name", "value": "test"}]'));
        $response = $this->request('POST', '/api/facebook-feed/filter?filter=' . $filter);
        $this->assertEquals(405, $response->getStatusCode());
    }

    public function testSingleLoggedInAsAnonymous()
    {
        $response = $this->request('GET', '/api/facebook-feed/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testSingleLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/facebook-feed/1');
        $this->assertJsonResponse($response, 403);
    }


    public function testSingleNotExistedIdLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/facebook-feed/0');
        $this->assertJsonResponse($response, 404);
    }

    public function testEditLoggedInAsAnonymous()
    {
        $response = $this->request('PUT', '/api/facebook-feed/1', [
            'facebook_feed' => [
                'email' => 'edit'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testEditLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('PUT', '/api/facebook-feed/1', [
            'facebook_feed' => [
                'email' => 'edit'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testEditLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/facebook-feed/1', [
            'facebook_feed' => [
                'email' => 'edited',
                'password' => 'edited',
                'time_interval' => 1000,
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertContainsKeys($response);
        $this->assertEquals('edited', $this->getResponseData($response)['email']);
        $this->assertEquals('edited', $this->getResponseData($response)['password']);
        $this->assertEquals(1000, $this->getResponseData($response)['time_interval']);
    }

    public function testEditNotExistedFieldLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/facebook-feed/1', [
            'facebook_feed' => [
                'name' => 'edit'
            ]
        ]);
        $this->assertJsonResponse($response, 400);
    }

    public function testDeleteLoggedInAsAnonymous()
    {
        $response = $this->request('DELETE', '/api/facebook-feed/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeleteLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('DELETE', '/api/facebook-feed/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeleteLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('DELETE', '/api/facebook-feed/1');
        $this->assertEquals(204, $response->getStatusCode());
    }



    public function getModelKeys()
    {
        return ['id', 'email', 'password', 'time_interval'];
    }
}
