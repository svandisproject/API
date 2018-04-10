<?php

namespace Kami\WorkerBundle\Security;

use Kami\WorkerBundle\Entity\Worker;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class WorkerUserProvider implements UserProviderInterface
{
    /**
     * @var RegistryInterface
     */
    private $doctrine;

    public function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function loadUserByUsername($username)
    {
        $worker = $this->doctrine->getRepository(Worker::class)->findOneBy([
            'secret' => $username
        ]);

        if (!$worker) {
            throw new UsernameNotFoundException(
                sprintf('Worker with secret "%s" does not exist.', $username)
            );
        }

        return $worker;
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof Worker) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return Worker::class === $class;
    }
}
