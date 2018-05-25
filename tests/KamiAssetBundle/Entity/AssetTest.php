<?php


namespace Kami\ContentBundle\Tests\Controller;

use Kami\Util\TestCase\ApiTestCase;


class AssetTest extends ApiTestCase
{
    public function testIndexLoggedInAsAnonymous()
    {
        $response = $this->request('GET', '/api/asset');
        $this->assertJsonResponse($response, 403);
    }

    public function testIndexLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/asset');
        $this->assertJsonResponse($response, 200);
    }

    public function testIndexLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/asset');
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsAnonymous()
    {
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "name", "value": "test"}]'));
        $response = $this->request('GET', '/api/asset/filter?filter=' . $filter);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsAnonymous()
    {
        $response = $this->request('POST', '/api/asset', [
            'asset' => [
                'name' => 'test',
                'symbol' => 'test',
                'rank' => 1,
                'price_usd' => 1.0,
                'price_btc' => 1.0,
                'volume_usd24h' => 1.0,
                'market_cap_usd' => 1.0,
                'available_supply' => 1.0,
                'total_supply' => 1.0,
                'max_supply' => 1.0,
                'percent_change1h' => 1.0,
                'percent_change24h' => 1.0,
                'percent_change7d' => 1.0,
                'last_updated' => '2000-00-00 10:00:00'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('POST', '/api/asset', [
            'asset' => [
                'name' => 'test',
                'symbol' => 'test',
                'rank' => 1,
                'price_usd' => 1.0,
                'price_btc' => 1.0,
                'volume_usd24h' => 1.0,
                'market_cap_usd' => 1.0,
                'available_supply' => 1.0,
                'total_supply' => 1.0,
                'max_supply' => 1.0,
                'percent_change1h' => 1.0,
                'percent_change24h' => 1.0,
                'percent_change7d' => 1.0,
                'last_updated' => '2000-00-00 10:00:00'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/asset', [
            'asset' => [
                'name' => 'test',
                'symbol' => 'test',
                'rank' => 1,
                'price_usd' => 1.0,
                'price_btc' => 1.0,
                'volume_usd24h' => 1.0,
                'market_cap_usd' => 1.0,
                'available_supply' => 1.0,
                'total_supply' => 1.0,
                'max_supply' => 1.0,
                'percent_change1h' => 1.0,
                'percent_change24h' => 1.0,
                'percent_change7d' => 1.0,
                'last_updated' => '2000-00-00 10:00:00'
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertEquals('test', $this->getResponseData($response)['name']);
        $this->assertContainsKeys($response);
    }

    public function testCreateLoggedInAsAdminWithNotUniqueName()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/asset', [
            'asset' => [
                'name' => 'test',
                'symbol' => 'test',
                'rank' => 1,
                'price_usd' => 1.0,
                'price_btc' => 1.0,
                'volume_usd24h' => 1.0,
                'market_cap_usd' => 1.0,
                'available_supply' => 1.0,
                'total_supply' => 1.0,
                'max_supply' => 1.0,
                'percent_change1h' => 1.0,
                'percent_change24h' => 1.0,
                'percent_change7d' => 1.0,
                'last_updated' => '2000-00-00 10:00:00'
            ]
        ]);
        $this->assertJsonResponse($response, 400);
    }

    public function testCreateByWorker()
    {
        $response = $this->requestByWorker('POST', '/api/asset', [
            'asset' => [
                'name' => 'test_worker',
                'symbol' => 'test_worker',
                'rank' => 1,
                'price_usd' => 1.0,
                'price_btc' => 1.0,
                'volume_usd24h' => 1.0,
                'market_cap_usd' => 1.0,
                'available_supply' => 1.0,
                'total_supply' => 1.0,
                'max_supply' => 1.0,
                'percent_change1h' => 1.0,
                'percent_change24h' => 1.0,
                'percent_change7d' => 1.0,
                'last_updated' => '2000-00-00 10:00:00'
            ]
        ]);
        $this->assertJsonResponse($response, 200);
    }

    public function testCreateByWorkerWithNotUniqueName()
    {
        $response = $this->requestByWorker('POST', '/api/asset', [
            'asset' => [
                'name' => 'test_worker',
                'symbol' => 'test',
                'rank' => 1,
                'price_usd' => 1.0,
                'price_btc' => 1.0,
                'volume_usd24h' => 1.0,
                'market_cap_usd' => 1.0,
                'available_supply' => 1.0,
                'total_supply' => 1.0,
                'max_supply' => 1.0,
                'percent_change1h' => 1.0,
                'percent_change24h' => 1.0,
                'percent_change7d' => 1.0,
                'last_updated' => '2000-00-00 10:00:00'
            ]
        ]);
        $this->assertJsonResponse($response, 400);
    }

    public function testFilterLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "name", "value": "test"}]'));
        $response = $this->request('GET', '/api/asset/filter?filter=' . $filter);
        $this->assertEquals('test', $this->getResponseData($response)['content'][0]['name']);
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsUser()
    {
        $this->logInAsUser();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "name", "value": "test"}]'));
        $response = $this->request('GET', '/api/asset/filter?filter=' . $filter);
        $this->assertEquals('test', $this->getResponseData($response)['content'][0]['name']);
        $this->assertJsonResponse($response, 200);
    }

    public function testUpdateLoggedInAsAnonymous()
    {
        $response = $this->request('PUT', '/api/asset/1', [
            'asset' => [
                'name' => 'edit',
                'symbol' => 'edit',
                'rank' => 1,
                'price_usd' => 1.0,
                'price_btc' => 1.0,
                'volume_usd24h' => 1.0,
                'market_cap_usd' => 1.0,
                'available_supply' => 1.0,
                'total_supply' => 1.0,
                'max_supply' => 1.0,
                'percent_change1h' => 1.0,
                'percent_change24h' => 1.0,
                'percent_change7d' => 1.0,
                'last_updated' => '2000-00-00 10:00:00'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testUpdateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('PUT', '/api/asset/1', [
            'asset' => [
                'name' => 'edit',
                'symbol' => 'edit',
                'rank' => 1,
                'price_usd' => 1.0,
                'price_btc' => 1.0,
                'volume_usd24h' => 1.0,
                'market_cap_usd' => 1.0,
                'available_supply' => 1.0,
                'total_supply' => 1.0,
                'max_supply' => 1.0,
                'percent_change1h' => 1.0,
                'percent_change24h' => 1.0,
                'percent_change7d' => 1.0,
                'last_updated' => '2000-00-00 10:00:00'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testUpdateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/asset/1', [
            'asset' => [
                'name' => 'edit',
                'symbol' => 'edit',
                'rank' => 1,
                'price_usd' => 1.0,
                'price_btc' => 1.0,
                'volume_usd24h' => 1.0,
                'market_cap_usd' => 1.0,
                'available_supply' => 1.0,
                'total_supply' => 1.0,
                'max_supply' => 1.0,
                'percent_change1h' => 1.0,
                'percent_change24h' => 1.0,
                'percent_change7d' => 1.0,
                'last_updated' => '2000-00-00 10:00:00'
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertContainsKeys($response);
        $this->assertEquals('edit', $this->getResponseData($response)['name']);
    }

    public function testUpdateNotExistedFieldLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/asset/1', ['asset' => ['title' => 'edit']]);
        $this->assertJsonResponse($response, 400);
    }

    public function testDeleteLoggedInAsAnonymous()
    {
        $response = $this->request('DELETE', '/api/asset/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeletePostLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('DELETE', '/api/asset/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeletePostLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('DELETE', '/api/asset/1');
        $this->assertEquals(204, $response->getStatusCode());
    }

    public function getModelKeys()
    {
        return ['name', 'symbol', 'rank', 'price_usd', 'price_usd', 'price_btc', 'volume_usd24h', 'market_cap_usd',
            'available_supply', 'total_supply', 'max_supply', 'percent_change1h', 'percent_change24h', 'percent_change7d', 'last_updated'];
    }
}