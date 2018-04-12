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

    public function getModelKeys()
    {
        return ['id', 'title'];
    }
}
