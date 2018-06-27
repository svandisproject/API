<?php

namespace Kami\Util\TestCase;

use Kami\WorkerBundle\Security\WorkerUserProvider;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Kami\WorkerBundle\Security\WorkerAuthenticator;
use Symfony\Component\Security\Core\User\UserProviderInterface;

abstract class ApiTestCase extends WebTestCase
{
    /**
     * @var array
     */
    protected $token;

    /**
     * @var string
     */
    protected $workerToken = 111;

    /**
     * @var int
     */
    protected $secondWorkerToken = 222;

    /**
     * @var string
     */
    protected $workerCode;
    /**
     * @return array
     */
    protected abstract function getModelKeys();

    /**
     * Calls a URI.
     *
     * @param string $method        The request method
     * @param string $uri           The URI to fetch
     * @param array  $parameters    The Request parameters
     * @param array  $files         The files
     * @param array  $server        The server parameters (HTTP headers are referenced with a HTTP_ prefix as PHP does)
     * @param string $content       The raw body data
     * @param bool   $changeHistory Whether to update the history or not (only used internally for back(), forward(), and reload())
     *
     * @return Response
     */
    protected function request($method, $uri, array $parameters = [], array $files = [], array $server = [], $content = null, $changeHistory = true)
    {
        $client = static::createClient();
        $client->followRedirects();
        $client->insulate(false);
        if($this->token) {
            $server = array_merge($server, [
                'HTTP_AUTHORIZATION' => $this->token,
            ]);
        }
        $client->request($method, $uri, $parameters, $files, $server, $content, $changeHistory);
        return $client->getResponse();
    }
    protected function logInAsAdmin()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/login_check',
            ['username' => 'admin@apimonster.com', 'password' => 'admin']
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->token = sprintf('Bearer %s', (json_decode($client->getResponse()->getContent()))->token);
    }
    protected function logInAsUser()
    {
        $client = static::createClient();
        $client->request(
            'POST', '/api/login_check', [
                'username' => 'user@apimonster.com',
                'password' => 'user' ]);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->token = sprintf('Bearer %s', (json_decode($client->getResponse()->getContent()))->token);
    }

    /**
     * Calls a URI.
     *
     * @param string $method        The request method
     * @param string $uri           The URI to fetch
     * @param array  $parameters    The Request parameters
     * @param array  $files         The files
     * @param array  $server        The server parameters (HTTP headers are referenced with a HTTP_ prefix as PHP does)
     * @param string $content       The raw body data
     * @param bool   $changeHistory Whether to update the history or not (only used internally for back(), forward(), and reload())
     *
     * @return Response
     */
    protected function requestByWorker($method,
                                       $uri,
                                       array $parameters = [],
                                       array $files = [],
                                       array $server = [],
                                       $content = null,
                                       $changeHistory = true,
                                       $second = false)
    {
        $client = static::createClient();
        $client->followRedirects();
        $client->insulate(false);
        if($this->workerToken) {
            $server = array_merge($server, [
                'HTTP_X-WORKER-TOKEN' => $second ? $this->secondWorkerToken : $this->workerToken,
            ]);
        }
        $client->request($method, $uri, $parameters, $files, $server, $content, $changeHistory);
        return $client->getResponse();
    }

    /**
     * @param $response
     * @param int $statusCode
     */
    protected function assertJsonResponse($response, $statusCode = 200)
    {
        $this->assertEquals(
            $statusCode, $response->getStatusCode()
        );
        $this->assertTrue(
            $response->headers->contains('Content-Type', 'application/json')
        );
    }

    /**
     * @param Response $response
     */
    protected function assertContainsKeys(Response $response)
    {
        $keys = $this->getModelKeys();
        $data = json_decode($response->getContent(), true);
        foreach ($keys as $key) {
            $this->assertArrayHasKey($key, $data, sprintf('Failed asserting that array has key: %s', $key));
        }
    }

    /**
     * @param Response $response
     * @return mixed
     */
    protected function getResponseData(Response $response)
    {
        return json_decode($response->getContent(), true);
    }
}