<?php

namespace Tests\KamiWorkerBundle\Controller;

use Kami\Util\TestCase\ApiTestCase;


class LogControllerTest extends ApiTestCase
{
    public function testIndexLoggedInAsAfnonymous()
    {
        $response = $this->request('GET', '/api/log');

        $this->assertJsonResponse($response, 200);
    }

    public function testIFilterLoggedInAsAfnonymous()
    {
        $filter = json_encode(base64_encode('[{"type": "eq", "property": "user_id", "value": "3"}]'));

        $response = $this->request('GET', '/api/log/filter?filter=' . $filter);

        $this->assertJsonResponse($response, 200);
    }

    public function getModelKeys()
    {
        return ['task_type', 'user_id', 'log', 'time'];
    }
}