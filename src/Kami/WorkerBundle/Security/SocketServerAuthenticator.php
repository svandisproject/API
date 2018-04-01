<?php

namespace Kami\WorkerBundle\Security;

use Kami\WorkerBundle\Model\SocketServer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class SocketServerAuthenticator extends AbstractGuardAuthenticator
{
    /**
     * @var string
     */
    private $socketServerSecret;

    /**
     * SocketServerAuthenticator constructor.
     *
     * @param string $socketServerSecret
     */
    public function __construct($socketServerSecret)
    {
        $this->socketServerSecret = $socketServerSecret;
    }

    /**
     * Called on every request to decide if this authenticator should be
     * used for the request. Returning false will cause this authenticator
     * to be skipped.
     */
    public function supports(Request $request)
    {
        return $request->headers->has('X-SOCKET-SERVER-TOKEN');
    }

    /**
     * Called on every request. Return whatever credentials you want to
     * be passed to getUser() as $credentials.
     */
    public function getCredentials(Request $request)
    {
        return array(
            'secret' => $request->headers->get('X-SOCKET-SERVER-TOKEN'),
        );
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $secret = $credentials['secret'];

        if (null === $secret || $secret !== $this->socketServerSecret) {
            return;
        }

        // if a User object, checkCredentials() is called
        return new SocketServer();
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $data = array(
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())
        );

        return new JsonResponse($data, Response::HTTP_FORBIDDEN);
    }

    /**
     * Called when authentication is needed, but it's not sent
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        $data = array(
            // you might translate this message
            'message' => 'Authentication Required'
        );

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    public function supportsRememberMe()
    {
        return false;
    }
}