<?php


namespace Kami\ContentBundle\Tests\Controller;


use Kami\Util\TestCase\ApiTestCase;

class LikeControllerTest extends ApiTestCase
{

    public function testIndexLoggedInAsAnonymous()
    {
        $response = $this->request('GET', '/api/like');
        $this->assertJsonResponse($response, 403);
    }

    public function testIndexLoggedInAsAdmin()
    {
        $this->logInAsAdmin();
        $response = $this->request('GET', '/api/like');
        $this->assertJsonResponse($response, 200);
    }

    public function testIndexLoggedInAsUser()
    {
        $this->logInAsUser();
        $response = $this->request('GET', '/api/like');
        $this->assertJsonResponse($response, 200);
    }

    public function testLikePostLoginAsAnonymous()
    {
        $response = $this->request('POST', '/api/like');
        $this->assertJsonResponse($response, 403);
    }

    public function testLikePostLoginAsUser()
    {
        $this->logInAsUser();

        $response = $this->request('POST', '/api/like', [
            'like' => [
                'post' => 1,
                'user' => 2
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertContainsKeys($response);
    }

    public function testLikePostLoginAsAdmin()
    {
        $this->logInAsAdmin();

        $response = $this->request('POST', '/api/like', [
            'like' => [
                'post' => 1,
                'user' => 1
            ]
        ]);
        $this->assertJsonResponse($response, 200);
        $this->assertContainsKeys($response);
    }

    public function testDoubleLikeOnePost()
    {

        $this->logInAsUser();

        $response = $this->request('POST', '/api/like', [
            'like' => [
                'post' => 1,
                'user' => 2
            ]
        ]);

        $this->assertJsonResponse($response, 400);
        $this->assertEquals("Trying to duplicate like for user 2 and post 1", $this->getResponseData($response)['error']['exception'][0]['message']);

    }

    public function getModelKeys()
    {
        return ['created_at', 'post'];
    }
}