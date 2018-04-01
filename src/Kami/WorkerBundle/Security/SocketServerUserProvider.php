<?php

namespace Kami\WorkerBundle\Security;


use Kami\WorkerBundle\Model\SocketServer;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class SocketServerUserProvider implements UserProviderInterface
{
    public function loadUserByUsername($username)
    {
        return new SocketServer();
    }

    public function refreshUser(UserInterface $user)
    {
        return;
    }

    public function supportsClass($class)
    {
        return SocketServer::class === $class;
    }

}