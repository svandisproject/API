<?php

namespace Kami\ContentBundle\Tests\Controller;

use Kami\TestCase\UserAwareTestCase;

class TagControllerTest extends UserAwareTestCase
{
    public function testTagCanBeCreatedByAnonymous()
    {
        $client = static::createClient();
        $client->request('post', '/api/tag', ['title' => 'test']);
        $response = $client->getResponse();
        $this->assertEquals(403, $response->getStatusCode());
    }

    public function testTagCantBeCreatedByUser()
    {
        $client = $this->loginAsUser();
        $client->request('post', '/api/tag', ['title' => 'test']);
        $response = $client->getResponse();
        $this->assertEquals(403, $response->getStatusCode());
    }

    public function testTagCanBeCreatedByAdmin()
    {
        $client = $this->loginAsAdmin();
        $client->request('post', '/api/tag', ['tag' => ['title' => 'test']]);
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testTagCantBeCreatedByAdminSameTitle()
    {
        $client = $this->loginAsAdmin();
        $client->request('post', '/api/tag', ['tag' => ['title' => 'test']]);
        $response = $client->getResponse();
        $this->assertEquals(400, $response->getStatusCode());
    }

    public function testTagCanBeAccessedIndexRouteByAdmin()
    {
        $client = $this->loginAsAdmin();
        $client->request('get', '/api/tag');
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testTagCanBeAccessedIndexRouteByUser()
    {
        $client = $this->loginAsUser();
        $client->request('get', '/api/tag');
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testTagCanBeAccessedIndexRouteByAnonymous()
    {
        $client = static::createClient();
        $client->request('get', '/api/tag');
        $response = $client->getResponse();
        $this->assertEquals(403, $response->getStatusCode());
    }

    public function testTagCanBeAccessedFilteredRouteByAdmin()
    {
        $client = $this->loginAsAdmin();
        $client->request('get', '/api/tag/filter?limit=1');
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(1, count(json_decode($response->getContent())->rows));
    }
    public function testTagCanBeAccessedFilteredRouteByUser()
    {
        $client = $this->loginAsUser();
        $client->request('get', '/api/tag/filter?limit=1');
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(1, count(json_decode($response->getContent())->rows));
    }

    public function testTagCanBeAccessedFilteredRouteByAnonymous()
    {
        $client = static::createClient();
        $client->request('get', '/api/tag/filter?limit=1');
        $response = $client->getResponse();
        $this->assertEquals(403, $response->getStatusCode());
    }

    public function testTagCanBeAccessedSingleRouteByAdmin()
    {
        $client = $this->loginAsAdmin();
        $client->request('get', '/api/tag/1');
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testTagCanBeAccessedSingleRouteByUser()
    {
        $client = $this->loginAsUser();
        $client->request('get', '/api/tag/1');
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testTagCantBeAccessedSingleRouteByAnonymous()
    {
        $client = static::createClient();
        $client->request('get', '/api/tag/1');
        $response = $client->getResponse();
        $this->assertEquals(403, $response->getStatusCode());
    }

    public function testTagCanBeEditedByAdmin()
    {
        $client = $this->loginAsAdmin();
        $client->request('put', '/api/tag/1', ['tag' => ['title' => 'test1']]);
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testTagCantBeEditedByUser()
    {
        $client = $this->loginAsUser();
        $client->request('put', '/api/tag/1', ['tag' => ['title' => 'test1']]);
        $response = $client->getResponse();
        $this->assertEquals(403, $response->getStatusCode());
    }

    public function testTagCanBeEditedByAnonymous()
    {
        $client = static::createClient();
        $client->request('put', '/api/tag/1', ['tag' => ['title' => 'test1']]);
        $response = $client->getResponse();
        $this->assertEquals(403, $response->getStatusCode());
    }

    public function testTagCantBeDeletedByAnonymous()
    {
        $client = static::createClient();
        $client->request('delete', '/api/tag/1');
        $response = $client->getResponse();
        $this->assertEquals(403, $response->getStatusCode());
    }

    public function testTagCantBeDeletedByUser()
    {
        $client = $this->loginAsUser();
        $client->request('delete', '/api/tag/1');
        $response = $client->getResponse();
        $this->assertEquals(403, $response->getStatusCode());
    }

    public function testTagCanBeDeletedByAdmin()
    {
        $client = $this->loginAsAdmin();
        $client->request('delete', '/api/tag/1');
        $response = $client->getResponse();
        $this->assertEquals(201, $response->getStatusCode());
    }
}
