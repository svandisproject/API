<?php

namespace Kami\WorkerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kami\ApiCoreBundle\Annotation as Api;

/**
 * TwitterUser
 *
 * @ORM\Table(name="twitter_user")
 * @ORM\Entity(repositoryClass="Kami\WorkerBundle\Repository\TwitterFeedRepository")
 * @Api\Access({"ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeEditedBy({"ROLE_ADMIN"})
 */
class TwitterFeed
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
     * @ORM\Column(name="mode", type="string", length=100)
     */
    private $mode;

    /**
     * @var string
     *
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeEditedBy({"ROLE_ADMIN"})
     * @ORM\Column(name="consumerKey", type="string", length=255)
     */
    private $consumerKey;

    /**
     * @var string
     *
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeEditedBy({"ROLE_ADMIN"})
     * @ORM\Column(name="consumerSecret", type="string", length=255)
     */
    private $consumerSecret;

    /**
     * @var string
     *
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeEditedBy({"ROLE_ADMIN"})
     * @ORM\Column(name="accessTokenKey", type="string", length=255)
     */
    private $accessTokenKey;

    /**
     * @var string
     *
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeEditedBy({"ROLE_ADMIN"})
     * @ORM\Column(name="accessTokenSecret", type="string", length=255)
     */
    private $accessTokenSecret;

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
     * Set mode.
     *
     * @param string $mode
     *
     * @return TwitterFeed
     */
    public function setMode($mode)
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * Get mode.
     *
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Set consumerKey.
     *
     * @param string $consumerKey
     *
     * @return TwitterFeed
     */
    public function setConsumerKey($consumerKey)
    {
        $this->consumerKey = $consumerKey;

        return $this;
    }

    /**
     * Get consumerKey.
     *
     * @return string
     */
    public function getConsumerKey()
    {
        return $this->consumerKey;
    }

    /**
     * Set consumerSecret.
     *
     * @param string $consumerSecret
     *
     * @return TwitterFeed
     */
    public function setConsumerSecret($consumerSecret)
    {
        $this->consumerSecret = $consumerSecret;

        return $this;
    }

    /**
     * Get consumerSecret.
     *
     * @return string
     */
    public function getConsumerSecret()
    {
        return $this->consumerSecret;
    }

    /**
     * Set accessTokenKey.
     *
     * @param string $accessTokenKey
     *
     * @return TwitterFeed
     */
    public function setAccessTokenKey($accessTokenKey)
    {
        $this->accessTokenKey = $accessTokenKey;

        return $this;
    }

    /**
     * Get accessTokenKey.
     *
     * @return string
     */
    public function getAccessTokenKey()
    {
        return $this->accessTokenKey;
    }

    /**
     * Set accessTokenSecret.
     *
     * @param string $accessTokenSecret
     *
     * @return TwitterFeed
     */
    public function setAccessTokenSecret($accessTokenSecret)
    {
        $this->accessTokenSecret = $accessTokenSecret;

        return $this;
    }

    /**
     * Get accessTokenSecret.
     *
     * @return string
     */
    public function getAccessTokenSecret()
    {
        return $this->accessTokenSecret;
    }

    /**
     * Set timeInterval.
     *
     * @param int $timeInterval
     *
     * @return TwitterFeed
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
