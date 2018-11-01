<?php


namespace Kami\AssetBundle\Tests\Controller;


use Kami\Util\TestCase\ApiTestCase;

class TradableTokenTest extends ApiTestCase
{
    public function testIndexLoggedInAsAnonymous()
    {
        $response = $this->request('GET', '/api/token');
        $this->assertJsonResponse($response, 403);
    }

    public function testIndexLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/token');
        $this->assertJsonResponse($response, 200);
    }

    public function testIndexLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/token');
        $this->assertJsonResponse($response, 200);
    }

    public function testCreateLoggedInAsAnonymous()
    {
        $response = $this->request('POST', '/api/token', [
            'tradable_token' => [
                'change' => 0.1,
                'weekly_change' => 1.1,
                'year_to_day_change' => -1,
                'ticker' => 'TEST',
                'title' => 'test',
                'algorithm' => 'test',
                'type' => 'test',
                'age' => 5,
                'sector' => 'test',
                'ico_amount' => 1,
                'return_on_ico' => 1.1,
                'market_cap' => 1.1,
                'price' => 1.1
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('POST', '/api/token', [
            'tradable_token' => [
                'change' => 0.1,
                'weekly_change' => 1.1,
                'year_to_day_change' => -1,
                'ticker' => 'TEST',
                'title' => 'test',
                'algorithm' => 'test',
                'type' => 'test',
                'age' => 5,
                'sector' => 'test',
                'ico_amount' => 1,
                'return_on_ico' => 1.1,
                'market_cap' => 1.1,
                'price' => 1.1
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/token', [
            'tradable_token' => [
                'change' => 0.31,
                'weekly_change' => 1.1,
                'year_to_day_change' => -1,
                'ticker' => 'TEST',
                'title' => 'test',
                'algorithm' => 'test',
                'type' => 'test',
                'age' => 5,
                'sector' => 'test',
                'ico_amount' => 1,
                'return_on_ico' => 1.1,
                'market_cap' => 1.1,
                'price' => 1.1
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertEquals('test', $this->getResponseData($response)['title']);
        $this->assertContainsKeys($response);
    }

    public function testCreateByWorker()
    {
        $response = $this->requestByWorker('POST', '/api/token', [
            'tradable_token' => [
                'change' => 0.31,
                'weekly_change' => 1.1,
                'year_to_day_change' => -1,
                'ticker' => 'TEST2',
                'title' => 'test2',
                'algorithm' => 'test',
                'type' => 'test',
                'age' => 5,
                'sector' => 'test',
                'ico_amount' => 1,
                'return_on_ico' => 1.1,
                'market_cap' => 1.1,
                'price' => 1.1
            ]
        ]);
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsAnonymous()
    {
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "title", "value": "test"}]'));
        $response = $this->request('GET', '/api/token/filter?filter=' . $filter);
        $this->assertJsonResponse($response, 403);
    }

    public function testFilterLoggedInAsUser()
    {
        $this->logInAsUser();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "title", "value": "test"}]'));
        $response = $this->request('GET', '/api/token/filter?filter=' . $filter);
        $this->assertEquals('test', $this->getResponseData($response)['content'][0]['title']);
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "title", "value": "test"}]'));
        $response = $this->request('GET', '/api/token/filter?filter=' . $filter);
        $this->assertEquals('test', $this->getResponseData($response)['content'][0]['title']);
        $this->assertJsonResponse($response, 200);
    }

    public function testUpdateLoggedInAsAnonymous()
    {
        $response = $this->request('PUT', '/api/token/1', [
            'tradable_token' => [
                'ticker' => 'TestTest',
                'title' => 'test_test',
                'price' => 1.12
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testUpdateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('PUT', '/api/token/1', [
            'tradable_token' => [
                'ticker' => 'TestTest',
                'title' => 'test_test',
                'price' => 1.12
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testUpdateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/token/1', [
            'tradable_token' => [
                'ticker' => 'TEST3',
                'title' => 'test3',
                'price' => 1.1
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertEquals('test3', $this->getResponseData($response)['title']);
    }

    public function testUpdateNotExistedFieldLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/token/1', ['tradable_token' => ['titl' => 'edit']]);
        $this->assertJsonResponse($response, 400);
    }

    public function getModelKeys()
    {
        return [
            'change',
            'weekly_change',
            'year_to_day_change',
            'ticker',
            'title',
            'algorithm',
            'type',
            'age',
            'sector',
            'ico_amount',
            'return_on_ico',
            'market_cap',
            'price'
        ];
    }

}