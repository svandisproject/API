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
                'country' => 'test',
                'restricted_countries' => '',
                'open_presale' => 1525137271,
                'kyc' => '',
                'hard_cap' => '',
                'total_cap' => '',
                'raised' => 1,
                'token_price' => 'test',
                'for_sale' => '',
                'token_sale_date' => 1525137271
            ]
        ]);
        $this->assertJsonResponse($response, 403);
    }

    public function getModelKeys()
    {
        return ['remote_id', 'title', 'asset', 'country', 'restricted_countries',
            'open_presale', 'kyc', 'hard_cap', 'total_cap', 'raised',
            'token_price', 'for_sale', 'token_sale_date'];
    }
}