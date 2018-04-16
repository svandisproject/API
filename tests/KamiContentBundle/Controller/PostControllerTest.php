<?php


namespace Kami\ContentBundle\Tests\Controller;

use Kami\Util\TestCase\ApiTestCase;


class PostControllerTest extends ApiTestCase
{
    public function testWorker()
    {
        $response = $this->requestByWorker('POST', '/api/post',
            ['post' =>
                [
                    'title' => 'test',
                    'url' => 'http://test.ua',
                    'content' => 'test_content',
                    'source' => 'test',
                    'publishedAt' => '01-01-2000 00:00:00'
                ]
            ]
        );
        $this->assertJsonResponse($response, 200);
    }

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

//        public function testCreatePostLoggedInAsUser()
//        {
//            $this->logInAsUser();
//        $response = $this->request('POST', '/api/post',
//            [
//                'post' => [
//                'title' => 'test',
//                'url' => 'test',
//                'content' => 'test',
//                'source' => 'test',
//                'publishedAt' => '01-01-2000 00:00:00'
//            ]]
//            );
//        $this->assertJsonResponse($response, 403);
//        }

//    public function testEditPostLoggedInAsUser()
//    {
//        $this->logInAsUser();
//        $response = $this->request('PUT', '/api/post/1',
//            [
//                'post' => [
//                    'title' => 'test',
//                    'url' => 'test',
//                    'content' => 'test',
//                    'source' => 'test',
//                    'publishedAt' => '01-01-2000 00:00:00'
//                ]]
//        );
//        $this->assertJsonResponse($response, 403);
//    }

//    public function testDeletePostLoggedInAsUser()
//    {
//        $this->logInAsUser();
//        $response = $this->request('DELETE', '/api/post/1');
//        $this->assertJsonResponse($response, 403);
//    }
//
//    public function testDeletePostLoggedInAsAdmin()
//    {
//        $this->logInAsAdmin();
//        $response = $this->request('DELETE', '/api/post/1');
//        $this->assertJsonResponse($response, 200);
//    }

//    public function testEditPostLoggedInAsAdmin()
//    {
//        $this->logInAsAdmin();
//        $response = $this->request('PUT', '/api/post/1',
//            [
//                'post' => [
//                    'title' => 'test',
//                    'url' => 'test',
//                    'content' => 'test',
//                    'source' => 'test',
//                    'publishedAt' => '01-01-2000 00:00:00'
//                ]]
//        );
//        $this->assertJsonResponse($response, 200);
//    }

//    public function testCreatePostLoggedInAsAdmin()
//    {
//        $this->logInAsAdmin();
//        $response = $this->request('POST', '/api/post',
//            [
//                'post' => [
//                    'title' => 'test',
//                    'url' => 'test',
//                    'content' => 'test',
//                    'source' => 'test',
//                    'publishedAt' => '01-01-2000 00:00:00'
//                ]]
//        );
//        $this->assertJsonResponse($response, 200);
//    }

//    public function testCreatePostByWorker()
//    {
//        $response = $this->requestByWorker(
//            'POST',
//            '/api/post',
//            ['post' => [
//                'title' => 'test',
//                'url' => 'test',
//                'content' => 'test',
//                'source' => 'test',
//                'publishedAt' => '01-01-2000 00:00:00'
//            ]]
//
//        );
//
//        dump($this->getResponseData($response));die;
//        $this->assertJsonResponse($response, 200);
//    }

    public function getModelKeys()
    {
        return ['id', 'title', 'url', 'content', 'source', 'publishedAt', 'createdAt', 'tags'];
    }
}