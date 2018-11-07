<?php


namespace Kami\IcoBundle\Tests;


use Kami\Util\TestCase\ApiTestCase;

class FinanceTest extends ApiTestCase
{

    public function testIndexLoggedInAsAnonymous()
    {
        $response = $this->request('GET', '/api/finance');
        $this->assertJsonResponse($response, 200);
    }

    public function testIndexLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/finance');
        $this->assertJsonResponse($response, 200);
    }

    public function testIndexLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/finance');
        $this->assertJsonResponse($response, 200);
    }

    public function testCreateLoggedInAsAnonymous()
    {
        $response = $this->request('POST', '/api/finance', [
            'finance' => [
                'token_price_eth' => 250,
                'accepted_currencies' => ['EUR', 'USD'],
                'circulating_supply' => 1000000000000
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('POST', '/api/finance', [
            'finance' => [
                'token_price_eth' => 250,
                'accepted_currencies' => ['EUR', 'USD'],
                'circulating_supply' => 1000000000000
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/finance', [
            'finance' => [
                'token_price_eth' => 250,
                'accepted_currencies' => ['EUR', 'USD'],
                'circulating_supply' => 1000000000000
            ]
        ]);

        $this->assertJsonResponse($response, 200);
        $this->assertEquals(250, $this->getResponseData($response)['token_price_eth']);
        $this->assertContainsKeys($response);
    }

    public function testCreateByWorker()
    {
        $response = $this->requestByWorker('POST', '/api/finance', [
            'finance' => [
                'token_price_eth' => 250,
                'accepted_currencies' => ['EUR', 'USD'],
                'circulating_supply' => 1000000000000
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testFilterLoggedInAsAnonymous()
    {
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "tokenPriceEth", "value": 250}]'));
        $response = $this->request('GET', '/api/finance/filter?filter=' . $filter);

        $this->assertEquals(250, $this->getResponseData($response)['content'][0]['token_price_eth']);
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "tokenPriceEth", "value": 250}]'));
        $response = $this->request('GET', '/api/finance/filter?filter=' . $filter);
        $this->assertEquals(250, $this->getResponseData($response)['content'][0]['token_price_eth']);
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsUser()
    {
        $this->logInAsUser();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "tokenPriceEth", "value": 250}]'));
        $response = $this->request('GET', '/api/finance/filter?filter=' . $filter);
        $this->assertEquals(250, $this->getResponseData($response)['content'][0]['token_price_eth']);
        $this->assertJsonResponse($response, 200);
    }

    public function testUpdateLoggedInAsAnonymous()
    {
        $response = $this->request('PUT', '/api/finance/1', [
            'finance' => [
                'token_price_eth' => 270,
                'accepted_currencies' => ['EUR', 'USD', 'UAH'],
                'circulating_supply' => 1000000000000
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testUpdateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('PUT', '/api/finance/1', [
            'finance' => [
                'token_price_eth' => 270,
                'accepted_currencies' => ['EUR', 'USD', 'UAH'],
                'circulating_supply' => 1000000000000
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testUpdateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/finance/1', [
            'finance' => [
                'token_price_eth' => 270,
                'accepted_currencies' => ['EUR', 'USD', 'UAH'],
                'circulating_supply' => 1000000000000
            ]
        ]);

        $this->assertJsonResponse($response, 200);
        $this->assertEquals(270, $this->getResponseData($response)['token_price_eth']);
    }

    public function testUpdateNotExistedFieldLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/finance/1', [
            'finance' => [
                'token_price_etr' => 270,
                'accepted_currencies' => ['EUR', 'USD', 'UAH'],
                'circulating_supply' => 1000000000000
            ]
        ]);
        $this->assertJsonResponse($response, 400);
    }

    public function testDeleteLoggedInAsAnonymous()
    {
        $response = $this->request('DELETE', '/api/finance/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeleteLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('DELETE', '/api/finance/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeleteLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('DELETE', '/api/finance/1');
        $this->assertEquals(204, $response->getStatusCode());
    }

    public function getModelKeys()
    {
        return ['token_price_eth', 'accepted_currencies', 'circulating_supply'];
    }

}