<?php

namespace Kami\UserBundle\Tests\Entity;

use function dump;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Kami\Util\TestCase\ApiTestCase;


class UserEntityTest extends ApiTestCase
{

    public function testGetUserIdFromPost()
    {
        $response = $this->request('GET', '/api/post/1');
        $user = $this->getResponseData($response)['created_by']['user'];
        $this->assertArrayHasKey('id', $user);
    }

    public function testFalseGettingUserPasswordFromPost()
    {
        $response = $this->request('GET', '/api/post/1');
        $user = $this->getResponseData($response)['created_by']['user'];
        $this->assertArrayNotHasKey('password', $user);
    }


    /**
     * @return array
     */
    protected function getModelKeys()
    {
        // TODO: Implement getModelKeys() method.
    }
}