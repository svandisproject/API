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
                'log' => 'test',
            ]
        ]);

        $this->assertJsonResponse($response, 200);
        $this->assertEquals('test', $this->getResponseData($response)['task_type']);
        $this->assertContainsKeys($response);
    }

    public function getModelKeys()
    {
        return ['task_type', 'user_id', 'log'];
    }
}