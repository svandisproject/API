<?php


namespace Kami\ContentBundle\Tests\Controller;

use Kami\Util\TestCase\ApiTestCase;


class PostControllerTest extends ApiTestCase
{

//    public function testIndexLoggedInAsAnonymous()
//    {
//        $response = $this->request('GET', '/api/post');
//        $this->assertJsonResponse($response, 403);
//    }
//
//    public function testIndexLoggedInAsAdmin()
//    {
//        $this->logInAsAdmin();
//        $response = $this->request('GET', '/api/post');
//        $this->assertJsonResponse($response, 200);
//    }
//
//    public function testIndexLoggedInAsUser()
//    {
//        $this->logInAsUser();
//        $response = $this->request('GET', '/api/post');
//        $this->assertJsonResponse($response, 200);
//    }
//
//    public function testFilterLoggedInAsAnonymous()
//    {
//        $response = $this->request('GET', '/api/post/filter');
//        $this->assertJsonResponse($response, 403);
//    }
//
//    public function testFilterLoggedInAsAdmin()
//    {
//        $this->logInAsAdmin();
//        $response = $this->request('GET', '/api/post/filter');
//        $this->assertJsonResponse($response, 200);
//    }

//    public function testFilterLoggedInAsUser()
//    {
//        $this->logInAsUser();
//        $response = $this->request('GET', '/api/post/filter');
//        $this->assertJsonResponse($response, 200);
//    }

    public function testFilterLoggedInAsUser()
    {
        $this->logInAsWorker();
        $response = $this->request('POST', '/api/post', ['post' => [
            'title' => 'test',
            'url' => 'test',
            'content' => 'test',
            'source' => 'test',
            'publishedAt' => '01-01-2000 00:00:00',
        ]]);
        dump($this->getResponseData($response));die;
        $this->assertJsonResponse($response, 200);
    }

    public function getModelKeys()
    {
        return ['id', 'title', 'url', 'content', 'source', 'publishedAt', 'createdAt', 'tags'];
    }
}