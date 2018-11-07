<?php


namespace Kami\IcoBundle\Tests;


use Kami\Util\TestCase\ApiTestCase;

class DatesTest extends ApiTestCase
{
    public function testIndexLoggedInAsAnonymous()
    {
        $response = $this->request('GET', '/api/dates');
        $this->assertJsonResponse($response, 200);
    }

    public function testIndexLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/dates');
        $this->assertJsonResponse($response, 200);
    }

    public function testIndexLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/dates');
        $this->assertJsonResponse($response, 200);
    }

    public function testCreateLoggedInAsAnonymous()
    {
        $response = $this->request('POST', '/api/dates', [
            'dates' => [
                'private_sale_start' => '2018-11-11 00:00:00',
                'private_sale_end' => '2018-11-11 00:00:10',
                'days_left' => 1
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('POST', '/api/dates', [
            'dates' => [
                'private_sale_start' => '2018-11-11 00:00:00',
                'private_sale_end' => '2018-11-11 00:00:10',
                'days_left' => 1
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/dates', [
            'dates' => [
                'private_sale_start' => '2018-11-11 00:00:00',
                'private_sale_end' => '2018-11-11 00:00:10',
                'days_left' => 1
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertEquals(1, $this->getResponseData($response)['days_left']);
        $this->assertContainsKeys($response);
    }

    public function testCreateByWorker()
    {
        $response = $this->requestByWorker('POST', '/api/dates', [
            'dates' => [
                'private_sale_start' => '2018-11-11 00:00:00',
                'private_sale_end' => '2018-11-11 00:00:10',
                'days_left' => 1
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testFilterLoggedInAsAnonymous()
    {
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "daysLeft", "value": 1}]'));
        $response = $this->request('GET', '/api/dates/filter?filter=' . $filter);

        $this->assertEquals(1, $this->getResponseData($response)['content'][0]['days_left']);
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "daysLeft", "value": 1}]'));
        $response = $this->request('GET', '/api/dates/filter?filter=' . $filter);
        $this->assertEquals(1, $this->getResponseData($response)['content'][0]['days_left']);
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsUser()
    {
        $this->logInAsUser();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "daysLeft", "value": 1}]'));
        $response = $this->request('GET', '/api/dates/filter?filter=' . $filter);
        $this->assertEquals(1, $this->getResponseData($response)['content'][0]['days_left']);
        $this->assertJsonResponse($response, 200);
    }

    public function testUpdateLoggedInAsAnonymous()
    {
        $response = $this->request('PUT', '/api/dates/1', [
            'dates' => [
                'private_sale_start' => '2018-11-11 00:00:00',
                'private_sale_end' => '2018-11-11 00:00:10',
                'days_left' => 2
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testUpdateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('PUT', '/api/dates/1', [
            'dates' => [
                'private_sale_start' => '2018-11-11 00:00:00',
                'private_sale_end' => '2018-11-11 00:00:10',
                'days_left' => 2
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testUpdateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/dates/1', [
            'dates' => [
                'private_sale_start' => '2018-11-11 00:00:00',
                'private_sale_end' => '2018-11-11 00:00:10',
                'days_left' => 2
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertContainsKeys($response);
        $this->assertEquals(2, $this->getResponseData($response)['days_left']);
    }

    public function testUpdateNotExistedFieldLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/dates/1', [
            'dates' => [
                'private_sale_start' => '2018-11-11 00:00:00',
                'private_sale_end' => '2018-11-11 00:00:10',
                'days_lef' => 1
            ]
        ]);
        $this->assertJsonResponse($response, 400);
    }

    public function testDeleteLoggedInAsAnonymous()
    {
        $response = $this->request('DELETE', '/api/dates/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeleteLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('DELETE', '/api/dates/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeleteLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('DELETE', '/api/dates/1');
        $this->assertEquals(204, $response->getStatusCode());
    }

    public function getModelKeys()
    {
        return ['private_sale_start', 'private_sale_end', 'days_left'];
    }
}