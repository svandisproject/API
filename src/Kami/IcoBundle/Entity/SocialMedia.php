<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kami\ApiCoreBundle\Annotation as Api;

/**
 * SocialMedia
 *
 * @ORM\Table(name="social_media")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\SocialMediaRepository")
 * @Api\AnonymousAccess()
 * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
 */
class SocialMedia
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
     * @var int
     *
     * @ORM\Column(name="twitter_followers", type="integer" nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $twitterFollowers;

    /**
     * @var int
     *
     * @ORM\Column(name="medium_followers", type="integer", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $mediumFollowers;

    /**
     * @var int
     *
     * @ORM\Column(name="telegram_followers", type="integer", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $telegramFollowers;

    /**
     * @var int
     *
     * @ORM\Column(name="reddit_subscribers", type="integer" nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $redditSubscribers;

    /**
     * @ORM\OneToOne(targetEntity="Ico", mappedBy="social_media")
     * @Api\Relation()
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    protected $ico;

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
     * Set twitterFollowers.
     *
     * @param int|null $twitterFollowers
     *
     * @return SocialMedia
     */
    public function setTwitterFollowers($twitterFollowers = null)
    {
        $this->twitterFollowers = $twitterFollowers;

        return $this;
    }

    /**
     * Get twitterFollowers.
     *
     * @return string|null
     */
    public function getTwitterFollowers()
    {
        return $this->twitterFollowers;
    }

    /**
     * Set mediumFollowers.
     *
     * @param int|null $mediumFollowers
     *
     * @return SocialMedia
     */
    public function setMediumFollowers($mediumFollowers = null)
    {
        $this->mediumFollowers = $mediumFollowers;

        return $this;
    }

    /**
     * Get mediumFollowers.
     *
     * @return int|null
     */
    public function getMediumFollowers()
    {
        return $this->mediumFollowers;
    }

    /**
     * Set telegramFollowers.
     *
     * @param int|null $telegramFollowers
     *
     * @return SocialMedia
     */
    public function setTelegramFollowers($telegramFollowers = null)
    {
        $this->telegramFollowers = $telegramFollowers;

        return $this;
    }

    /**
     * Get telegramFollowers.
     *
     * @return int|null
     */
    public function getTelegramFollowers()
    {
        return $this->telegramFollowers;
    }

    /**
     * Set redditSubscribers.
     *
     * @param int|null $redditSubscribers
     *
     * @return SocialMedia
     */
    public function setRedditSubscribers($redditSubscribers = null)
    {
        $this->redditSubscribers = $redditSubscribers;

        return $this;
    }

    /**
     * Get redditSubscribers.
     *
     * @return int|null
     */
    public function getRedditSubscribers()
    {
        return $this->redditSubscribers;
    }

    /**
     * @param Ico $ico
     *
     * @return self
     */
    public function setIco($ico)
    {
        $this->ico = $ico;
        $ico->setSocialMedia($this);
        return $this;
    }

}
