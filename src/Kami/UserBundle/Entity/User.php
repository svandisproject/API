<?php

namespace Kami\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use RandomLib\Factory;
use SecurityLib\Strength;

/**
 * @ORM\Entity
 * @ORM\Table(name="`user`")
 * @ORM\Entity(repositoryClass="Kami\UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=16)
     */
    private $workerToken;

    public function __construct()
    {
        $factory = new Factory;
        $generator = $factory->getGenerator(new Strength(Strength::MEDIUM));
        $this->workerToken = $generator->generateString(16, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
        parent::__construct();

    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        parent::setEmail($email);
        $this->setUsername($email);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getWorkerToken()
    {
        return $this->workerToken;
    }

    /**
     * @param mixed $token
     * @return User
     */
    public function setWorkerToken($workerToken)
    {
        $this->workerToken = $workerToken;

        return $this;
    }

    public function updateWorkerToken()
    {
        $factory = new Factory;
        $generator = $factory->getGenerator(new Strength(Strength::MEDIUM));
        $this->workerToken = $generator->generateString(16, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
    }
}
