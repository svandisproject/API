<?php


namespace Kami\AssetBundle\Tests\Controller;


use function dump;
use Kami\Util\TestCase\ApiTestCase;

class MarketCapTest extends ApiTestCase
{

    public function testIndexLoggedAsAnonymous()
    {
        $response = $this->request('GET', '/api/market-cap');
        $this->assertJsonResponse($response, 200);
    }

    public function testIndexLoggedAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/market-cap');
        $this->assertJsonResponse($response, 200);
    }

    public function testIndexLoggedAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/market-cap');
        $this->assertJsonResponse($response, 200);
    }

    public function testCreateLoggedInAsAnonymous()
    {
        $response = $this->request('POST', '/api/market-cap', [
            'market_cap' => [
                'circulating_supply' => 1,
                'market_cap' => 1,
                'volume24' => 1,
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('POST', '/api/market-cap', [
            'market_cap' => [
                'circulating_supply' => 1,
                'market_cap' => 1,
                'volume24' => 1,
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/market-cap', [
            'market_cap' => [
                'circulating_supply' => 1,
                'market_cap' => 1,
                'volume24' => 1,
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertEquals('1', $this->getResponseData($response)['circulating_supply']);
        $this->assertContainsKeys($response);
    }

    public function testFilterLoggedInAsAnonymous()
    {
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "marketCap", "value": "1"}]'));
        $response = $this->request('GET', '/api/market-cap/filter?filter=' . $filter);
        $this->assertEquals('1', $this->getResponseData($response)['content'][0]['market_cap']);
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsUser()
    {
        $this->logInAsUser();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "marketCap", "value": "1"}]'));
        $response = $this->request('GET', '/api/market-cap/filter?filter=' . $filter);
        $this->assertEquals('1', $this->getResponseData($response)['content'][0]['market_cap']);
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "marketCap", "value": "1"}]'));
        $response = $this->request('GET', '/api/market-cap/filter?filter=' . $filter);
        $this->assertEquals('1', $this->getResponseData($response)['content'][0]['market_cap']);
        $this->assertJsonResponse($response, 200);
    }

    public function testUpdateLoggedInAsAnonymous()
    {
        $response = $this->request('PUT', '/api/market-cap/1', [
            'market_cap' => [
                'market_cap' => 21,
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testUpdateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('PUT', '/api/market-cap/1', [
            'market_cap' => [
                'market_cap' => 21,
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testUpdateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/market-cap/1', [
            'market_cap' => [
                'circulating_supply' => 21
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertEquals(21, $this->getResponseData($response)['circulating_supply']);
    }

    public function testDeleteLoggedInAsAnonymous()
    {
        $response = $this->request('DELETE', '/api/market-cap/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeletePostLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('DELETE', '/api/market-cap/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeletePostLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('DELETE', '/api/market-cap/1');
        $this->assertEquals(204, $response->getStatusCode());
    }

    public function getModelKeys()
    {
        return ['circulating_supply', 'market_cap', 'volume24'];
    }

}