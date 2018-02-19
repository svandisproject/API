<?php

namespace Kami\WorkerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Worker
 *
 * @ORM\Table(name="worker")
 * @ORM\Entity(repositoryClass="Kami\WorkerBundle\Repository\WorkerRepository")
 */
class Worker
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="host", type="string", length=255)
     */
    private $host;

    /**
     * @var string
     *
     * @ORM\Column(name="secret", type="string", length=128, unique=true)
     */
    private $secret;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_seen_at", type="datetime", nullable=true)
     */
    private $lastSeenAt;

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
}
