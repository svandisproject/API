<?php

namespace Kami\WorkerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kami\ApiCoreBundle\Annotation as Api;

/**
 * RedditFeed
 *
 * @ORM\Table(name="reddit_feed")
 * @ORM\Entity(repositoryClass="Kami\WorkerBundle\Repository\RedditFeedRepository")
 * @Api\Access({"ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeEditedBy({"ROLE_ADMIN"})
 */
class RedditFeed
{
    /**
     * @var int
     *
     * @Api\Access({"ROLE_ADMIN"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeEditedBy({"ROLE_ADMIN"})
     * @ORM\Column(name="client_id", type="string", unique=true)
     */
    private $clientId;

    /**
     * @var string
     *
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeEditedBy({"ROLE_ADMIN"})
     * @ORM\Column(name="client_secret", type="string")
     */
    private $clientSecret;

    /**
     * @var string
     *
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeEditedBy({"ROLE_ADMIN"})
     * @ORM\Column(name="user_name", type="string")
     */
    private $userName;

    /**
     * @var string
     *
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeEditedBy({"ROLE_ADMIN"})
     * @ORM\Column(name="user_password", type="string")
     */
    private $userPassword;

    /**
     * @var int
     *
     * @ORM\Column(name="timeInterval", type="integer")
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeEditedBy({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     */
    private $timeInterval;


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
     * Set email.
     *
     * @param string $clientId
     *
     * @return RedditFeed
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Get clientId.
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set clientSecret.
     *
     * @param string $clientSecret
     *
     * @return RedditFeed
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;

        return $this;
    }

    /**
     * Get clientSecret.
     *
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * Set userName.
     *
     * @param string $userName
     *
     * @return RedditFeed
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get userName.
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set userPassword.
     *
     * @param string $userPassword
     *
     * @return RedditFeed
     */
    public function setUserPassword($userPassword)
    {
        $this->userPassword = $userPassword;

        return $this;
    }

    /**
     * Get userPassword.
     *
     * @return string
     */
    public function getuUerPassword()
    {
        return $this->userPassword;
    }

    /**
     * Set timeInterval.
     *
     * @param int $timeInterval
     *
     * @return RedditFeed
     */
    public function setTimeInterval($timeInterval)
    {
        $this->timeInterval = $timeInterval;

        return $this;
    }

    /**
     * Get timeInterval.
     *
     * @return int
     */
    public function getTimeInterval()
    {
        return $this->timeInterval;
    }
}
