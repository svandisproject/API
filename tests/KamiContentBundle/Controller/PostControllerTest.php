<?php


namespace Kami\ContentBundle\Tests\Controller;

use Kami\Util\TestCase\ApiTestCase;


class PostControllerTest extends ApiTestCase
{
    public function testIndexLoggedInAsAnonymous()
    {
        $response = $this->request('GET', '/api/post');
        $this->assertJsonResponse($response, 403);
    }

    public function testIndexLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/post');
        $this->assertJsonResponse($response, 200);
    }

    public function testIndexLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/post');
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsAnonymous()
    {
        $filter = base64_encode('[{"type": "eq", "property": "title", "value": "Test post 1"}]');
        $response = $this->request('GET', '/api/post/filter?filter=' . $filter);
        $this->assertJsonResponse($response, 403);

    }

    public function testFilterLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $filter = base64_encode('[{"type": "eq", "property": "title", "value": "Test post 1"}]');
        $response = $this->request('GET', '/api/post/filter?filter=' . $filter);
        $this->assertEquals('Test post 1', $this->getResponseData($response)['content'][0]['title']);
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsUser()
    {
        $this->logInAsUser();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "title", "value": "Test post 1"}]'));
        $response = $this->request('GET', '/api/post/filter?filter=' . $filter);
        $this->assertEquals('Test post 1', $this->getResponseData($response)['content'][0]['title']);
        $this->assertJsonResponse($response, 200);
    }

    public function testCreateLoggedInAsAnonymous()
    {
        $response = $this->request('POST', '/api/post', [
            'post' => [
                'title' => 'test',
                'url' => 'test',
                'content' => 'test',
                'source' => 'test',
                'published_at' => '01-01-2000 00:00:00'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreatePostLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('POST', '/api/post', [
            'post' => [
                'title' => 'test',
                'url' => 'test',
                'content' => 'test',
                'source' => 'test',
                'published_at' => '01-01-2000 00:00:00'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreatePostLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/post', [
            'post' => [
                'title' => 'test',
                'url' => 'test',
                'content' => 'test',
                'source' => 'test',
                'published_at' => '01-01-2000 00:00:00'
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertEquals('test', $this->getResponseData($response)['title']);
        $this->assertContainsKeys($response);
    }

    public function testCreatePostLoggedInAsAdminWithNotUniqueUrl()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/post', [
            'post' => [
                'title' => 'test',
                'url' => 'test',
                'content' => 'test',
                'source' => 'test',
                'published_at' => '01-01-2000 00:00:00'
            ]
        ]);
        $this->assertJsonResponse($response, 400);
    }

    public function testCreatePostByWorker()
    {
        $response = $this->requestByWorker('POST', '/api/post', [
            'post' => [
                'title' => 'test',
                'url' => 'http://test.com',
                'content' => 'test',
                'source' => 'test',
                'published_at' => '01-01-2000 00:00:00'
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertEquals('http://test.com', $this->getResponseData($response)['url']);
    }

    public function testCreatePostByWorkerWithNotUniqueUrl()
    {
        $response = $this->requestByWorker('POST', '/api/post', [
            'post' => [
                'title' => 'test',
                'url' => 'http://test.com',
                'content' => 'test',
                'source' => 'test',
                'published_at' => '01-01-2000 00:00:00'
            ]
        ]);
        $this->assertJsonResponse($response, 400);
    }

    public function testEditPostLoggedInAsAnonymous()
    {
        $response = $this->request('PUT', '/api/post/1', [
            'post' => [
                'title' => 'test',
                'url' => 'test',
                'content' => 'test',
                'source' => 'test',
                'published_at' => '01-01-2000 00:00:00'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testEditPostLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('PUT', '/api/post/1', [
            'post' => [
                'title' => 'test',
                'url' => 'test',
                'content' => 'test',
                'source' => 'test',
                'published_at' => '01-01-2000 00:00:00'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testEditPostLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/post/1', [
            'post' => [
                'title' => 'test2',
                'url' => 'http://test2.com',
                'content' => 'test',
                'source' => 'test',
                'published_at' => '01-01-2001 00:00:00'
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertContainsKeys($response);
        $this->assertEquals('test2', $this->getResponseData($response)['title']);
    }

    public function testEditNotExistedFieldLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/post/1', ['post' => ['name' => 'edit']]);
        $this->assertJsonResponse($response, 400);
    }

    public function testDeletePostLoggedInAsAnonymous()
    {
        $response = $this->request('DELETE', '/api/post/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeletePostLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('DELETE', '/api/post/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeletePostLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('DELETE', '/api/post/1');
        $this->assertEquals(204, $response->getStatusCode());
    }

    public function getModelKeys()
    {
        return ['title', 'url', 'content', 'source', 'published_at'];
    }
}