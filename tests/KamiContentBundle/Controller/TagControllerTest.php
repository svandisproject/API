<?php

namespace Kami\ContentBundle\Tests\Controller;

use Kami\Util\TestCase\ApiTestCase;

class TagControllerTest extends ApiTestCase
{
    public function testIndexLoggedInAsAnonymous()
    {
        $response = $this->request('GET', '/api/tag');
        $this->assertJsonResponse($response, 403);
    }

    public function testIndexLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/tag');
        $this->assertJsonResponse($response, 200);
    }

    public function testIndexLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/tag');
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsAnonymous()
    {
        $response = $this->request('GET', '/api/tag/filter');
        $this->assertJsonResponse($response, 403);
    }

    public function testFilterLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/tag/filter');
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/tag/filter');
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterByExistingParameterLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/tag/filter?title=bitcoin');
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLimitLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/tag/filter?limit=1');
        $this->assertJsonResponse($response, 200);
        $response = $this->getResponseData($response);
        $this->assertCount(1, $response['rows']);
    }

    public function testCreateLoggedInAsAnonymous()
    {
        $response = $this->request('POST', '/api/tag', ['tag' => ['title' => 'test']]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('POST', '/api/tag', ['tag' => ['title' => 'test']]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/tag', ['tag' => ['title' => 'test']]);
        $this->assertJsonResponse($response, 200);
    }

    public function testCreateNotExistedFieldLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/tag', ['tag' => ['name' => 'test']]);
        $this->assertJsonResponse($response, 400);
        $this->assertEquals('This form should not contain extra fields.', $this->getResponseData($response)['form']['errors'][0]);
    }

    public function testSingleLoggedInAsAnonymous()
    {
        $response = $this->request('GET', '/api/tag/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testSingleLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/tag/1');
        $this->assertJsonResponse($response, 200);
    }

    public function testSingleLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/tag/1');
        $this->assertJsonResponse($response, 200);
    }

    public function testSingleNotExistedIdLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/tag/0');
        $this->assertJsonResponse($response, 404);
    }

    public function testEditLoggedInAsAnonymous()
    {
        $response = $this->request('PUT', '/api/tag/1', ['tag' => ['title' => 'edit']]);
        $this->assertJsonResponse($response, 403);
    }

    public function testEditLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('PUT', '/api/tag/1', ['tag' => ['title' => 'edit']]);
        $this->assertJsonResponse($response, 403);
    }

    public function testEditLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/tag/1', ['tag' => ['title' => 'edit']]);
        $this->assertJsonResponse($response, 200);
    }

    public function testEditNotExistedFieldLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/tag/1', ['tag' => ['name' => 'edit']]);
        $this->assertJsonResponse($response, 400);
        $this->assertEquals('This form should not contain extra fields.', $this->getResponseData($response)['form']['errors'][0]);
    }

    public function testDeleteLoggedInAsAnonymous()
    {
        $response = $this->request('DELETE', '/api/tag/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeleteLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('DELETE', '/api/tag/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeleteLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('DELETE', '/api/tag/1');
        $this->assertJsonResponse($response, 201);
    }



    public function getModelKeys()
    {
        return ['id', 'title'];
    }
}
