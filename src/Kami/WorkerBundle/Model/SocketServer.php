<?php

namespace Kami\WorkerBundle\Model;


use Symfony\Component\Security\Core\User\UserInterface;

class SocketServer implements UserInterface
{
    public function getRoles()
    {
        return ['ROLE_SOCKET_SERVER'];
    }

    public function getPassword()
    {
        return '';
    }

    public function getSalt()
    {
        return '';
    }

    public function getUsername()
    {
        return '';
    }

    public function eraseCredentials()
    {
        return '';
    }

}