<?php


namespace Kami\IcoBundle\Tests;


use Kami\Util\TestCase\ApiTestCase;

class LegalTest extends ApiTestCase
{

    public function testIndexLoggedInAsAnonymous()
    {
        $response = $this->request('GET', '/api/legal');
        $this->assertJsonResponse($response, 200);
    }

    public function testIndexLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/legal');
        $this->assertJsonResponse($response, 200);
    }

    public function testIndexLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/legal');
        $this->assertJsonResponse($response, 200);
    }

    public function testCreateLoggedInAsAnonymous()
    {
        $response = $this->request('POST', '/api/legal', [
            'legal' => [
                'company_name' => 'test',
                'office_locations' => ['test1'],
                'team_kyc' => true
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('POST', '/api/legal', [
            'legal' => [
                'company_name' => 'test',
                'office_locations' => ['test1'],
                'team_kyc' => true
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/legal', [
            'legal' => [
                'company_name' => 'test',
                'office_locations' => ['test1'],
                'team_kyc' => true
            ]
        ]);

        $this->assertJsonResponse($response, 200);
        $this->assertEquals("test", $this->getResponseData($response)['company_name']);
        $this->assertContainsKeys($response);
    }

    public function testCreateByWorker()
    {
        $response = $this->requestByWorker('POST', '/api/legal', [
            'legal' => [
                'company_name' => 'test',
                'office_locations' => ['test1'],
                'team_kyc' => true
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testFilterLoggedInAsAnonymous()
    {
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "companyName", "value": "test"}]'));
        $response = $this->request('GET', '/api/legal/filter?filter=' . $filter);

        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "companyName", "value": "test"}]'));
        $response = $this->request('GET', '/api/legal/filter?filter=' . $filter);
        $this->assertEquals("test", $this->getResponseData($response)['content'][0]['company_name']);
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsUser()
    {
        $this->logInAsUser();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "companyName", "value": "test"}]'));
        $response = $this->request('GET', '/api/legal/filter?filter=' . $filter);
        $this->assertEquals("test", $this->getResponseData($response)['content'][0]['company_name']);
        $this->assertJsonResponse($response, 200);
    }

    public function testUpdateLoggedInAsAnonymous()
    {
        $response = $this->request('PUT', '/api/legal/1', [
            'legal' => [
                'company_name' => 'test2'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testUpdateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('PUT', '/api/legal/1', [
            'legal' => [
                'company_name' => 'test2'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testUpdateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/legal/1', [
            'legal' => [
                'company_name' => 'test2'
            ]
        ]);

        $this->assertJsonResponse($response, 200);
        $this->assertEquals("test2", $this->getResponseData($response)['company_name']);
    }

    public function testUpdateNotExistedFieldLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/legal/1', [
            'legal' => [
                'company_nam' => 'test',
                'office_locations' => ['test1'],
                'team_kyc' => true
            ]
        ]);
        $this->assertJsonResponse($response, 400);
    }

    public function testDeleteLoggedInAsAnonymous()
    {
        $response = $this->request('DELETE', '/api/legal/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeleteLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('DELETE', '/api/legal/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeleteLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('DELETE', '/api/legal/1');
        $this->assertEquals(204, $response->getStatusCode());
    }

    public function getModelKeys()
    {
        return ['company_name', 'office_locations', 'team_kyc'];
    }
}