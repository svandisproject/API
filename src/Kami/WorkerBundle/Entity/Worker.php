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
 * @Api\Access({"ROLE_ADMIN"})
 */
class Worker implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Api\Access({"ROLE_ADMIN"})
     */
    private $id;

//    /**
//     * @var string
//     *
//     * @ORM\Column(name="host", type="string", length=255)
//     * @Api\Access({"ROLE_ADMIN"})
//     */
//    private $host;

    /**
     * @var string
     *
     * @ORM\Column(name="secret", type="string", length=128, unique=true)
     * @Api\Access({"ROLE_ADMIN"})
     */
    private $secret;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_seen_at", type="datetime", nullable=true)
     * @Api\Access({"ROLE_ADMIN"})
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
     * Set host.
     *
     * @param string $host
     *
     * @return Worker
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get рhost.
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
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

}
