<?php


namespace Kami\IcoBundle\Tests;


use Kami\Util\TestCase\ApiTestCase;

class IcoValuesTest extends ApiTestCase
{
    public function testIndexLoggedInAsAnonymous()
    {
        $response = $this->request('GET', '/api/ico-values');
        $this->assertJsonResponse($response, 200);
    }

    public function testIndexLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/ico-values');
        $this->assertJsonResponse($response, 200);
    }

    public function testIndexLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/ico-values');
        $this->assertJsonResponse($response, 200);
    }

    public function testCreateLoggedInAsAnonymous()
    {
        $response = $this->request('POST', '/api/ico-values', [
            'ico_values' => [
                'project_completion',
                'listing_order'
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('POST', '/api/ico-values', [
            'ico_values' => [
                'project_completion' => 1,
                'listing_order' => 1
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testCreateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('POST', '/api/ico-values', [
            'ico_values' => [
                'project_completion' => 1,
                'listing_order' => 1
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertEquals(1, $this->getResponseData($response)['project_completion']);
        $this->assertContainsKeys($response);
    }

    public function testCreateByWorker()
    {
        $response = $this->requestByWorker('POST', '/api/ico-values', [
            'ico_values' => [
                'project_completion' => 1,
                'listing_order' => 1
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testFilterLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "projectCompletion", "value": 1}]'));
        $response = $this->request('GET', '/api/ico-values/filter?filter=' . $filter);
        $this->assertEquals(1, $this->getResponseData($response)['content'][0]['project_completion']);
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsAnonymous()
    {
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "projectCompletion", "value": 1}]'));
        $response = $this->request('GET', '/api/ico-values/filter?filter=' . $filter);
        $this->assertEquals(1, $this->getResponseData($response)['content'][0]['project_completion']);
        $this->assertJsonResponse($response, 200);
    }

    public function testFilterLoggedInAsUser()
    {
        $this->logInAsUser();
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "projectCompletion", "value": 1}]'));
        $response = $this->request('GET', '/api/ico-values/filter?filter=' . $filter);
        $this->assertEquals(1, $this->getResponseData($response)['content'][0]['project_completion']);
        $this->assertJsonResponse($response, 200);
    }

    public function testUpdateLoggedInAsAnonymous()
    {
        $response = $this->request('PUT', '/api/ico-values/1', [
            'ico_values' => [
                'project_completion' => 1,
                'listing_order' => 1
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testUpdateLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('PUT', '/api/ico-values/1', [
            'ico_values' => [
                'project_completion' => 1,
                'listing_order' => 1
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function testUpdateLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/ico-values/1', [
            'ico_values' => [
                'project_completion' => 2,
                'listing_order' => 1
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertContainsKeys($response);
        $this->assertEquals(2, $this->getResponseData($response)['project_completion']);
    }

    public function testUpdateNotExistedFieldLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('PUT', '/api/ico-values/1', [
            'ico_values' => [
                'project_completio' => 1,
                'listing_order' => 1
            ]
        ]);
        $this->assertJsonResponse($response, 400);
    }

    public function testDeleteLoggedInAsAnonymous()
    {
        $response = $this->request('DELETE', '/api/ico-values/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeleteLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('DELETE', '/api/ico-values/1');
        $this->assertJsonResponse($response, 403);
    }

    public function testDeleteLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('DELETE', '/api/ico-values/1');
        $this->assertEquals(204, $response->getStatusCode());
    }

    public function getModelKeys()
    {
        return [
            'project_completion',
            'listing_order'
        ];
    }

}