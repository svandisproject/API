<?php

namespace Kami\WorkerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Kami\ApiCoreBundle\Annotation as Api;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Worker
 *
 * @ORM\Table(name="worker")
 * @ORM\Entity(repositoryClass="Kami\WorkerBundle\Repository\WorkerRepository")
 * @Api\Access({"ROLE_USER"})
 */
class Worker implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Api\Access({"ROLE_USER"})
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     * @ORM\ManyToOne(targetEntity="User", inversedBy="workers")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     * @Api\Access({"ROLE_USER"})
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="secret", type="string", length=128, unique=true)
     * @Api\Access({"ROLE_USER"})
     */
    private $secret;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_seen_at", type="datetime", nullable=true)
     * @Api\Access({"ROLE_USER"})
     */
    private $lastSeenAt;

    /**
     * @var array
     */
    private $roles = ['ROLE_WORKER'];

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set secret.
     *
     * @param string $secret
     *
     * @return Worker
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;

        return $this;
    }

    /**
     * Get secret.
     *
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param \DateTime $lastSeenAt
     * @return Worker
     */
    public function setLastSeenAt($lastSeenAt)
    {
        $this->lastSeenAt = $lastSeenAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLastSeenAt()
    {
        return $this->lastSeenAt;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    public function getPassword()
    {
        return;
    }

    public function getSalt()
    {
        return;
    }

    public function getUsername()
    {
        return;
    }

    public function eraseCredentials()
    {
        return;
    }


    /**
     * Set userId.
     *
     * @param int $userId
     *
     * @return Worker
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get userId.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set user.
     *
     * @param int $user
     *
     * @return Worker
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }
}
