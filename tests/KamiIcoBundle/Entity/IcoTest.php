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
                'asset' => '',
                'kyc' => '',
                'hard_cap' => '',
                'total_cap' => '',
                'raised' => 1,
                'token_price' => 'test',
                'for_sale' => 0,
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
                'asset' => '',
                'kyc' => '',
                'hard_cap' => '',
                'total_cap' => '',
                'raised' => 1,
                'token_price' => 'test',
                'for_sale' => 0,
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
                'asset' => '',
                'kyc' => '',
                'hard_cap' => '1000 tests',
                'total_cap' => '2000 tests',
                'raised' => 1,
                'token_price' => 'test',
                'for_sale' => 0,
            ]
        ]);
        $this->assertContainsKeys($response);
        $this->assertJsonResponse($response, 200);
    }

    public function testCreateLoggedInAsWorker()
    {
        $response = $this->requestByWorker('POST', '/api/ico', [
            'ico' => [
                'remote_id' => '1',
                'title' => 'test',
                'asset' => '',
                'kyc' => '',
                'hard_cap' => '',
                'total_cap' => '',
                'raised' => 1,
                'token_price' => 'test',
                'for_sale' => 0,
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
                'asset' => '',
                'kyc' => '',
                'hard_cap' => '',
                'total_cap' => '',
                'raised' => 12,
                'token_price' => 'test2',
                'for_sale' => 0,
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
                'asset' => '',
                'kyc' => '',
                'hard_cap' => '',
                'total_cap' => '',
                'raised' => 12,
                'token_price' => 'test2',
                'for_sale' => 0,
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
                'title' => 'test2',
                'kyc' => '',
                'hard_cap' => '1000 tests',
                'total_cap' => '1000 tests',
                'raised' => 12,
                'token_price' => 'test2',
                'for_sale' => 0,
            ]
        ]);

        $this->assertJsonResponse($response, 200);
        $this->assertContainsKeys($response);
        $this->assertEquals('test2', $this->getResponseData($response)['title']);
    }

    public function getModelKeys()
    {
        return [
            'remote_id', 'title', 'kyc', 'hard_cap', 'total_cap', 'raised',
            'token_price', 'for_sale',
        ];
    }
}