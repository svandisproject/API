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
                'volume_usd_day' => 1.0,
                'market_cap_usd' => 1.0,
                'circulating_supply' => 1.0,
                'total_supply' => 1.0,
                'max_supply' => 1.0,
                'price_usd' => 1.0,
                'percent_change_hour_usd' => 1.0,
                'percent_change_day_usd' => 1.0,
                'percent_change_week_usd' => 1.0,
                'last_updated' => 1525137271
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
                'volume_usd_day' => 1.0,
                'market_cap_usd' => 1.0,
                'circulating_supply' => 1.0,
                'total_supply' => 1.0,
                'max_supply' => 1.0,
                'price_usd' => 1.0,
                'percent_change_hour_usd' => 1.0,
                'percent_change_day_usd' => 1.0,
                'percent_change_week_usd' => 1.0,
                'last_updated' => 1525137271
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
                'volume_usd_day' => 1.0,
                'market_cap_usd' => 1.0,
                'circulating_supply' => 1.0,
                'total_supply' => 1.0,
                'max_supply' => 1.0,
                'price_usd' => 1.0,
                'percent_change_hour_usd' => 1.0,
                'percent_change_day_usd' => 1.0,
                'percent_change_week_usd' => 1.0,
                'last_updated' => 1525137271
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertEquals('test', $this->getResponseData($response)['name']);
        $this->assertContainsKeys($response);
    }

    public function testCreateByWorker()
    {
        $response = $this->requestByWorker('POST', '/api/asset', [
            'asset' => [
                'name' => 'test_worker',
                'symbol' => 'test_worker',
                'rank' => 1,
                'volume_usd_day' => 1.0,
                'market_cap_usd' => 1.0,
                'circulating_supply' => 1.0,
                'total_supply' => 1.0,
                'max_supply' => 1.0,
                'price_usd' => 1.0,
                'percent_change_hour_usd' => 1.0,
                'percent_change_day_usd' => 1.0,
                'percent_change_week_usd' => 1.0,
                'last_updated' => 1525137271
            ]
        ]);
        $this->assertJsonResponse($response, 200);
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
                'volume_usd_day' => 1.0,
                'market_cap_usd' => 1.0,
                'circulating_supply' => 1.0,
                'total_supply' => 1.0,
                'max_supply' => 1.0,
                'price_usd' => 1.0,
                'percent_change_hour_usd' => 1.0,
                'percent_change_day_usd' => 1.0,
                'percent_change_week_usd' => 1.0,
                'last_updated' => 1525137271
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
                'volume_usd_day' => 1.0,
                'market_cap_usd' => 1.0,
                'circulating_supply' => 1.0,
                'total_supply' => 1.0,
                'max_supply' => 1.0,
                'price_usd' => 1.0,
                'percent_change_hour_usd' => 1.0,
                'percent_change_day_usd' => 1.0,
                'percent_change_week_usd' => 1.0,
                'last_updated' => 1525137271
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
                'volume_usd_day' => 1.0,
                'market_cap_usd' => 1.0,
                'circulating_supply' => 1.0,
                'total_supply' => 1.0,
                'max_supply' => 1.0,
                'price_usd' => 1.0,
                'percent_change_hour_usd' => 1.0,
                'percent_change_day_usd' => 1.0,
                'percent_change_week_usd' => 1.0,
                'last_updated' => 1525137271
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
        return ['name', 'symbol', 'rank', 'price_usd', 'volume_usd_day', 'market_cap_usd',
            'circulating_supply', 'total_supply', 'max_supply', 'percent_change_hour_usd', 'percent_change_day_usd',
            'percent_change_week_usd', 'last_updated'];
    }
}