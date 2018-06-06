<?php

namespace Kami\WorkerBundle\Tests\Controller;

use Kami\Util\TestCase\ApiTestCase;

class WebFeedTest extends ApiTestCase
{

    public function testIndexLoggedInAsAnonymous()
    {
        $response = $this->request('GET', '/api/web-feed');
        $this->assertJsonResponse($response, 403);
    }

    public function testIndexLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/web-feed');
        $this->assertJsonResponse($response, 403);
    }

    public function testIndexLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/web-feed');
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsAnonymous()
    {
        $filter = base64_encode('[{"type": "eq", "property": "title", "value": "Coindesk"}]');
        $response = $this->request('GET', '/api/web-feed/filter?filter=' . $filter);
        $this->assertJsonResponse($response, 403);
    }

    public function testFilterLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $filter = base64_encode('[{"type": "eq", "property": "title", "value": "Coindesk"}]');
        $response = $this->request('GET', '/api/web-feed/filter?filter=' . $filter);
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsUser()
    {
        $this->logInAsUser();
        $filter = base64_encode('[{"type": "eq", "property": "title", "value": "Coindesk"}]');
        $response = $this->request('GET', '/api/web-feed/filter?filter=' . $filter);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsAnonymous()
    {
        $response = $this->request('POST', '/api/web-feed', [
            'web_feed' => [
                'title' => 'test',
                'url' => 'test',
                'link_selector' => 'test',
                'time_interval' => 1000
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('POST', '/api/web-feed', [
            'web_feed' => [
                'title' => 'test',
                'url' => 'test',
                'link_selector' => 'test',
                'time_interval' => 1000
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/web-feed', [
            'web_feed' => [
                'title' => 'test',
                'url' => 'test',
                'link_selector' => 'test',
                'time_interval' => 1000
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertEquals('test', $this->getResponseData($response)['title']);
        $this->assertContainsKeys($response);
    }

    public function testCreateLoggedInAsAdminWithNotUniqueTitle()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/web-feed', [
            'web_feed' => [
                'title' => 'test',
                'url' => 'test2',
                'link_selector' => 'test',
                'time_interval' => 1000
            ]
        ]);
        $this->assertJsonResponse($response, 400);;
    }

    public function testCreateLoggedInAsAdminWithNotUniqueUrl()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/web-feed', [
            'web_feed' => [
                'title' => 'test2',
                'url' => 'test',
                'link_selector' => 'test',
                'time_interval' => 1000
            ]
        ]);
        $this->assertJsonResponse($response, 400);;
    }

    public function testCreateNotExistedFieldLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/web-feed', [
            'web_feed' => [
                'name' => 'test',
                'url' => 'test',
                'link_selector' => 'test',
                'time_interval' => 1000
            ]
        ]);
        $this->assertJsonResponse($response, 400);
    }

    public function testSingleLoggedInAsAnonymous()
    {
        $response = $this->request('GET', '/api/web-feed/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testSingleLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/web-feed/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testSingleLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/web-feed/1');
        $this->assertJsonResponse($response, 200);
        $this->assertContainsKeys($response);
    }

    public function testSingleNotExistedIdLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/web-feed/0');
        $this->assertJsonResponse($response, 404);
    }

    public function testEditLoggedInAsAnonymous()
    {
        $response = $this->request('PUT', '/api/web-feed/1', [
            'web_feed' => [
                'title' => 'test1',
                'url' => 'test1',
                'link_selector' => 'test1',
                'time_interval' => 1010
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testEditLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('PUT', '/api/web-feed/1', [
            'web_feed' => [
                'title' => 'test1',
                'url' => 'test1',
                'link_selector' => 'test1',
                'time_interval' => 1010
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testEditLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/web-feed/1', [
            'web_feed' => [
                'title' => 'test1',
                'url' => 'test1',
                'link_selector' => 'test1',
                'time_interval' => 1010
            ]
        ]);

        $this->assertJsonResponse($response, 200);
        $this->assertEquals('test1', $this->getResponseData($response)['title']);
        $this->assertContainsKeys($response);
    }

    public function testFilterByExistingParameterLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "title", "value": "Coindesk"}]'));
        $response = $this->request('GET', '/api/web-feed/filter?filter=' . $filter);
        $this->assertJsonResponse($response, 200);
    }

    public function testDeleteLoggedInAsAnonymous()
    {
        $response = $this->request('DELETE', '/api/web-feed/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeleteLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('DELETE', '/api/web-feed/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeleteLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('DELETE', '/api/web-feed/1');
        $this->assertEquals(204, $response->getStatusCode());
    }

    public function getModelKeys()
    {
        return ['title', 'url', 'link_selector', 'time_interval'];
    }
}