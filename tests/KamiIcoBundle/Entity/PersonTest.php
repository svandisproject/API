<?php


namespace Kami\IcoBundle\Tests;


use Kami\Util\TestCase\ApiTestCase;

class PersonTest extends ApiTestCase
{
    public function testIndexLoggedInAsAnonymous()
    {
        $response = $this->request('GET', '/api/person');
        $this->assertJsonResponse($response, 403);
    }

    public function testIndexLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/person');
        $this->assertJsonResponse($response, 200);
    }

    public function testIndexLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/person');
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsAnonymous()
    {
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "url", "value": "test"}]'));
        $response = $this->request('GET', '/api/mood-signal/filter?filter=' . $filter);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsAnonymous()
    {
        $response = $this->request('POST', '/api/person', [
            'person' => [
                'name' => 'test',
                'title' => 'test',
                'url' => 'test'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('POST', '/api/person', [
            'person' => [
                'name' => 'test',
                'title' => 'test',
                'url' => 'test'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/person', [
            'person' => [
                'name' => 'test',
                'title' => 'test',
                'url' => 'test'
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertEquals('test', $this->getResponseData($response)['title']);
        $this->assertContainsKeys($response);
    }

    public function testCreateLoggedInAsAdminNotUniqueUrl()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/person', [
            'person' => [
                'name' => 'test2',
                'title' => 'test2',
                'url' => 'test'
            ]
        ]);

        $this->assertJsonResponse($response, 400);
    }

    public function testCreateByWorker()
    {
        $response = $this->requestByWorker('POST', '/api/person', [
            'person' => [
                'name' => 'test',
                'title' => 'test',
                'url' => 'test'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testFilterLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "url", "value": "test"}]'));
        $response = $this->request('GET', '/api/person/filter?filter=' . $filter);
        $this->assertEquals('test', $this->getResponseData($response)['content'][0]['title']);
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsUser()
    {
        $this->logInAsUser();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "url", "value": "test"}]'));
        $response = $this->request('GET', '/api/person/filter?filter=' . $filter);
        $this->assertEquals('test', $this->getResponseData($response)['content'][0]['title']);
        $this->assertJsonResponse($response, 200);
    }

    public function testUpdateLoggedInAsAnonymous()
    {
        $response = $this->request('PUT', '/api/person/1', [
            'person' => [
                'name' => 'test',
                'title' => 'test',
                'url' => 'test'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testUpdateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('PUT', '/api/person/1', [
            'person' => [
                'name' => 'test',
                'title' => 'test',
                'url' => 'test'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testUpdateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/person/1', [
            'person' => [
                'name' => 'test2',
                'title' => 'test2',
                'url' => 'test'
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertContainsKeys($response);
        $this->assertEquals('test2', $this->getResponseData($response)['title']);
    }

    public function testUpdateNotExistedFieldLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/person/1', [
            'person' => [
                'name' => 'test',
                'titl' => 'test',
                'url' => 'test'
            ]
        ]);
        $this->assertJsonResponse($response, 400);
    }

    public function testDeleteLoggedInAsAnonymous()
    {
        $response = $this->request('DELETE', '/api/person/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeleteLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('DELETE', '/api/person/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeleteLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('DELETE', '/api/person/1');
        $this->assertEquals(204, $response->getStatusCode());
    }

    public function getModelKeys()
    {
       return [
           'name',
           'title',
           'url'
           ];
    }
}