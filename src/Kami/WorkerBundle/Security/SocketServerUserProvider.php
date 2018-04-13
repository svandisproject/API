<?php

namespace Kami\WorkerBundle\Security;

use Kami\WorkerBundle\Model\SocketServer;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class SocketServerUserProvider implements UserProviderInterface
{
    /**
     * @param string $username
     * @return bool|SocketServer|UserInterface
     */
    public function loadUserByUsername($username)
    {
        if ('SOCKET_SERVER' === $username) {
            return new SocketServer();
        }
        return false;
    }

    /**
     * @param UserInterface $user
     * @return UserInterface|void
     */
    public function refreshUser(UserInterface $user)
    {
        return;
    }

    /**
     * @param string $class
     * @return bool
     */
    public function supportsClass($class)
    {
        return SocketServer::class === $class;
    }
}
