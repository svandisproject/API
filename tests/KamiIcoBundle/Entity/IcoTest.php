<?php

namespace Kami\IcoBundle\Tests;

use Kami\Util\TestCase\ApiTestCase;

class IcoTest extends ApiTestCase
{

    public function testIndexLoggedInAsAnonymous()
    {
        $response = $this->request('GET', '/api/ico');

        $this->assertJsonResponse($response, 200);
    }

    public function testIndexLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/ico');
        $this->assertJsonResponse($response, 200);
    }

    public function testIndexLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/ico');
        $this->assertJsonResponse($response, 200);
    }

    public function testCreateLoggedInAsAnonymous()
    {
        $response = $this->request('POST', '/api/ico', [
            'ico' => [
                'remote_id' => '1',
                'title' => 'test',
                'description' => 'test',
                'slogan' => 'test',
                'problem' => 'test',
                'country' => 'tst',
                'for_sale' => 0,
                'staff_size' => 1,
                'restricted_countries' => ['test', 'test1']
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('POST', '/api/ico', [
            'ico' => [
                'remote_id' => '1',
                'title' => 'test',
                'description' => 'test',
                'slogan' => 'test',
                'problem' => 'test',
                'country' => 'tst',
                'for_sale' => 0,
                'staff_size' => 1,
                'restricted_countries' => ['test', 'test1']
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/ico', [
            'ico' => [
                'remote_id' => '1',
                'title' => 'test',
                'description' => 'test',
                'slogan' => 'test',
                'problem' => 'test',
                'country' => 'tst',
                'for_sale' => 0,
                'staff_size' => 1,
                'restricted_countries' => ['test1', 'test2']
            ]
        ]);
        $this->assertContainsKeys($response);
        $this->assertJsonResponse($response, 200);
    }

    public function testCreateLoggedInAsWorker()
    {
        $response = $this->requestByWorker('POST', '/api/ico', [
            'ico' => [
                'remote_id' => '2',
                'title' => 'test2',
                'description' => 'test2',
                'slogan' => 'test2',
                'problem' => 'test2',
                'country' => 'ts2',
                'for_sale' => 0,
                'staff_size' => 1,
                'restricted_countries' => ['test2', 'test3']
            ]
        ]);

        $this->assertJsonResponse($response, 403);
    }

    public function testFilterLoggedInAsUser()
    {
        $this->logInAsUser();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "title", "value": "test"}]'));
        $response = $this->request('GET', '/api/ico/filter?filter=' . $filter);
        $this->assertEquals('test', $this->getResponseData($response)['content'][0]['title']);
        $this->assertJsonResponse($response, 200);
    }

    public function testUpdateLoggedInAsAnonymous()
    {
        $response = $this->requestByWorker('PUT', '/api/ico/1', [
            'ico' => [
                'remote_id' => '1',
                'title' => 'test2',
                'description' => 'test',
                'slogan' => 'test',
                'problem' => 'test',
                'country' => 'tst',
                'for_sale' => 0,
                'staff_size' => 1,
                'restricted_countries' => ['test', 'test1']
            ]
        ]);

        $this->assertJsonResponse($response, 403);
    }

    public function testUpdateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('PUT', '/api/ico/1', [
            'ico' => [
                'remote_id' => '1',
                'title' => 'test2',
                'description' => 'test',
                'slogan' => 'test',
                'problem' => 'test',
                'country' => 'tst',
                'for_sale' => 0,
                'staff_size' => 1,
                'restricted_countries' => ['test', 'test1']
            ]
        ]);

        $this->assertJsonResponse($response, 403);
    }

    public function testUpdateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/ico/1', [
            'ico' => [
                'remote_id' => '1',
                'title' => 'test3',
                'description' => 'test',
                'slogan' => 'test',
                'problem' => 'test',
                'country' => 'tst',
                'for_sale' => 0,
                'staff_size' => 1,
                'restricted_countries' => ['test', 'test1']
            ]
        ]);

        $this->assertJsonResponse($response, 200);
        $this->assertContainsKeys($response);
        $this->assertEquals('test3', $this->getResponseData($response)['title']);
    }

    public function getModelKeys()
    {
        return [
            'remote_id', 'title', 'description', 'slogan', 'problem', 'country',
            'for_sale', 'staff_size', 'restricted_countries'
        ];
    }
}