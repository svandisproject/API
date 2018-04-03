<?php

namespace Kami\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use RandomLib\Factory;
use SecurityLib\Strength;

/**
 * @ORM\Entity
 *
 * @ORM\Table(name="`user`")
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

    /**
     * @var string
     * @ORM\Column(type="string")
     * @ORM\OneToMany(targetEntity="Worker", mappedBy="`user`")
     */
    private $workers;

    public function __construct()
    {
        $factory = new Factory;
        $generator = $factory->getGenerator(new Strength(Strength::MEDIUM));
        $this->workerToken = $generator->generateString(16, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $this->workers = new ArrayCollection();
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

    /**
     * Set workers.
     *
     * @param string $workers
     *
     * @return User
     */
    public function setWorkers($workers)
    {
        $this->workers = $workers;

        return $this;
    }

    /**
     * Get workers.
     *
     * @return string
     */
    public function getWorkers()
    {
        return $this->workers;
    }
}
