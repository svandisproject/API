<?php


namespace Kami\IcoBundle\Tests;


use Kami\Util\TestCase\ApiTestCase;

class DepartmentControllerTest extends ApiTestCase
{
    public function testIndexLoggedInAsAnonymous()
    {
        $response = $this->request('GET', '/api/department');
        $this->assertJsonResponse($response, 403);
    }

    public function testIndexLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/department');
        $this->assertJsonResponse($response, 200);
    }

    public function testIndexLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/department');
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsAnonymous()
    {
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "title", "value": "test"}]'));
        $response = $this->request('GET', '/api/department/filter?filter=' . $filter);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsAnonymous()
    {
        $response = $this->request('POST', '/api/department', [
            'department' => [
                'title' => 'test'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('POST', '/api/department', [
            'department' => [
                'title' => 'test'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/department', [
            'department' => [
                'title' => 'test'
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertEquals('test', $this->getResponseData($response)['title']);
        $this->assertContainsKeys($response);
    }

    public function testCreateByWorker()
    {
        $response = $this->requestByWorker('POST', '/api/department', [
            'department' => [
                'title' => 'test'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testFilterLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "title", "value": "test"}]'));
        $response = $this->request('GET', '/api/department/filter?filter=' . $filter);
        $this->assertEquals('test', $this->getResponseData($response)['content'][0]['title']);
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsUser()
    {
        $this->logInAsUser();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "title", "value": "test"}]'));
        $response = $this->request('GET', '/api/department/filter?filter=' . $filter);
        $this->assertEquals('test', $this->getResponseData($response)['content'][0]['title']);
        $this->assertJsonResponse($response, 200);
    }

    public function testUpdateLoggedInAsAnonymous()
    {
        $response = $this->request('PUT', '/api/department/1', [
            'department' => [
                'title' => 'test2'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testUpdateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('PUT', '/api/department/1', [
            'department' => [
                'title' => 'test2'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testUpdateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/department/1', [
            'department' => [
                'title' => 'edit'
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertContainsKeys($response);
        $this->assertEquals('edit', $this->getResponseData($response)['title']);
    }

    public function testUpdateNotExistedFieldLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/department/1', ['department' => [
            'titl' => 'edit'
        ]]);
        $this->assertJsonResponse($response, 400);
    }

    public function testDeleteLoggedInAsAnonymous()
    {
        $response = $this->request('DELETE', '/api/department/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeleteLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('DELETE', '/api/department/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeleteLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('DELETE', '/api/department/1');
        $this->assertEquals(204, $response->getStatusCode());
    }


    public function getModelKeys()
    {
        return ['title'];
    }

}