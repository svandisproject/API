<?php
/**
 * Created by PhpStorm.
 * User: amazing
 * Date: 4/13/18
 * Time: 11:50 AM
 */

namespace Tests\KamiWorkerBundle\Security;

use Kami\WorkerBundle\Entity\Worker;
use Kami\WorkerBundle\Model\SocketServer;
use Kami\WorkerBundle\Security\SocketServerAuthenticator;
use Kami\WorkerBundle\Security\SocketServerUserProvider;
use Symfony\Bundle\FrameworkBundle\Tests\Functional\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class SocketServerAuthenticatorTest extends WebTestCase
{

    public function testSupportsWithNeededHeader()
    {
        $socketServerAuthenticator = new SocketServerAuthenticator('testSocketServerSecret');
        $request = new Request();
        $request->headers->set('X-SOCKET-SERVER-TOKEN', 'testSocketServerSecret');
        $this->assertTrue($socketServerAuthenticator->supports($request));
    }
    public function testSupportsWithoutNeededHeader()
    {
        $socketServerAuthenticator = new SocketServerAuthenticator('testSocketServerSecret');
        $request = new Request();
        $this->assertFalse($socketServerAuthenticator->supports($request));
    }

    public function testOnAuthenticationFailure()
    {
        $socketServerAuthenticator = new SocketServerAuthenticator('testSocketServerSecret');
        $request = new Request();
        $response = $socketServerAuthenticator->onAuthenticationFailure($request, new AuthenticationException());
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(403, $response->getStatusCode());
        $this->assertEquals('An authentication exception occurred.', json_decode($response->getContent())->message);
    }

    public function testCanBeConstructed()
    {
        $socketServerAuthenticator = new SocketServerAuthenticator('secret');
        $this->assertInstanceOf(SocketServerAuthenticator::class, $socketServerAuthenticator);
    }

    public function testStart()
    {
        $socketServerAuthenticator = new SocketServerAuthenticator('testSocketServerSecret');
        $request = new Request();
        $response = $socketServerAuthenticator->start($request);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(401, $response->getStatusCode());
        $this->assertEquals('Authentication Required', json_decode($response->getContent())->message);
    }

    public function testCheckCredentialsWithIncorrectUser()
    {
        $socketServerAuthenticator = new SocketServerAuthenticator('testSocketServerSecret');
        $this->assertFalse(
            $socketServerAuthenticator->checkCredentials(
                ['username'=>'SOCKET_SERVER', 'secret'=>'testSocketServerSecret'],
                new Worker()
            )
        );
    }

    public function testCheckCredentialsWithCorrectUser()
    {
        $socketServerAuthenticator = new SocketServerAuthenticator('testSocketServerSecret');
        $this->assertTrue(
            $socketServerAuthenticator->checkCredentials(
                ['username'=>'SOCKET_SERVER', 'secret'=>'testSocketServerSecret'],
                new SocketServer()
            )
        );
    }

    public function testGetUserWithCorrectCredentials()
    {
        $socketServerAuthenticator = new SocketServerAuthenticator('testSocketServerSecret');
        $user = $socketServerAuthenticator->getUser(
            ['secret'=>'testSocketServerSecret'],
            new SocketServerUserProvider()
        );

        $this->assertInstanceOf(SocketServer::class, $user);
    }

    public function testGetUserWithIncorrectCredentials()
    {
        $socketServerAuthenticator = new SocketServerAuthenticator('testSocketServerSecret');
        $user = $socketServerAuthenticator->getUser(
            ['secret'=>'incorrect'],
            new SocketServerUserProvider()
        );
        $this->assertNull($user);
    }

    public function testGetCredentials()
    {
        $socketServerAuthenticator = new SocketServerAuthenticator('testSocketServerSecret');
        $request = new Request();
        $request->headers->set('X-SOCKET-SERVER-TOKEN', 'testSocketServerSecret');
        $this->assertEquals(
            ['secret' => 'testSocketServerSecret', 'username' => 'SOCKET_SERVER'],
            $socketServerAuthenticator->getCredentials($request));
    }

    public function testSupportsRememberMe()
    {
        $socketServerAuthenticator = new SocketServerAuthenticator('testSocketServerSecret');
        $this->assertFalse($socketServerAuthenticator->supportsRememberMe());
    }

    public function testOnAuthenticationSuccess()
    {
        $request = new Request();
        $request->headers->set('X-SOCKET-SERVER-TOKEN', 'testSocketServerSecret');
        $socketServerAuthenticator = new SocketServerAuthenticator('testSocketServerSecret');
        $this->assertNull(
            $socketServerAuthenticator->onAuthenticationSuccess(
                $request,
                $this->createMock(TokenInterface::class),
                'null'
            ));
    }
}
