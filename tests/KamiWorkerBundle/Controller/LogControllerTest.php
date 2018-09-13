<?php

namespace Tests\KamiWorkerBundle\Controller;

use Kami\Util\TestCase\ApiTestCase;


class LogControllerTest extends ApiTestCase
{
    public function testCreateLoggedInAsAfnonymous()
    {
        $response = $this->request('POST', '/api/log', [
            'log' => [
                'task_type' => 'test',
                'user_id' => 1,
                'log' => 'test3',
            ]
        ]);
        $response = $this->request('POST', '/api/log', [
            'log' => [
                'task_type' => '2_test',
                'user_id' => 2,
                'log' => 'test3',
            ]
        ]);

        $response = $this->request('POST', '/api/log', [
            'log' => [
                'task_type' => '1_test',
                'user_id' => 1,
                'log' => 'test3',
            ]
        ]);

        $this->assertJsonResponse($response, 200);
        $this->assertEquals('test2', $this->getResponseData($response)['task_type']);
        $this->assertContainsKeys($response);
    }

//    public function testIndexLoggedInAsAfnonymous()
//    {
//        $response = $this->request('GET', '/api/log');
//
//        dump($this->getResponseData($response));die;
//        $this->assertJsonResponse($response, 200);
//        $this->assertEquals('test', $this->getResponseData($response)['task_type']);
//        $this->assertContainsKeys($response);
//    }

    public function getModelKeys()
    {
        return ['task_type', 'user_id', 'log'];
    }
}