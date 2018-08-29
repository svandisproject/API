<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kami\ApiCoreBundle\Annotation as Api;

/**
 * Links
 *
 * @ORM\Table(name="links")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\LinksRepository")
 * @Api\AnonymousAccess()
 * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
 */
class Links
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
     * @var string|null
     *
     * @ORM\Column(name="twitter_account", type="string", length=255)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $twitterAccount;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telegram_chatroom", type="string", length=255, nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $telegramChatroom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="reddit_channel", type="string", length=255, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $redditChannel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="facebook_page", type="string", length=255, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $facebookPage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="medium_page", type="string", length=255, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $mediumPage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="steemit_page", type="string", length=255, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $steemitPage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="discord_page", type="string", length=255, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $discordPage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="website_link", type="string", length=255, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $websiteLink;

    /**
     * @var string|null
     * @ORM\Column(name="video_presentetion", type="string", length=255, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $videoPresentetion;

    /**
     * @var string | null
     * @ORM\Column(name="airdrops", type="string", length=255, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $airdrops;

    /**
     * @var string | null
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $bounties;

    /**
     * @ORM\OneToOne(targetEntity="Kami\IcoBundle\Entity\Ico", mappedBy="links")
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $ico;


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
     * Set twitterAccount.
     *
     * @param string|null $twitterAccount
     *
     * @return SocialMediaLinks
     */
    public function setTwitterAccount($twitterAccount = null)
    {
        $this->twitterAccount = $twitterAccount;

        return $this;
    }

    /**
     * Get twitterAccount.
     *
     * @return string|null
     */
    public function getTwitterAccount()
    {
        return $this->twitterAccount;
    }

    /**
     * Set telegramChatroom.
     *
     * @param string|null $telegramChatroom
     *
     * @return SocialMediaLinks
     */
    public function setTelegramChatroom($telegramChatroom = null)
    {
        $this->telegramChatroom = $telegramChatroom;

        return $this;
    }

    /**
     * Get telegramChatroom.
     *
     * @return string|null
     */
    public function getTelegramChatroom()
    {
        return $this->telegramChatroom;
    }

    /**
     * Set redditChannel.
     *
     * @param string|null $redditChannel
     *
     * @return SocialMediaLinks
     */
    public function setRedditChannel($redditChannel = null)
    {
        $this->redditChannel = $redditChannel;

        return $this;
    }

    /**
     * Get redditChannel.
     *
     * @return string|null
     */
    public function getRedditChannel()
    {
        return $this->redditChannel;
    }

    /**
     * Set facebookPage.
     *
     * @param string|null $facebookPage
     *
     * @return SocialMediaLinks
     */
    public function setFacebookPage($facebookPage = null)
    {
        $this->facebookPage = $facebookPage;

        return $this;
    }

    /**
     * Get facebookPage.
     *
     * @return string|null
     */
    public function getFacebookPage()
    {
        return $this->facebookPage;
    }

    /**
     * Set mediumPage.
     *
     * @param string|null $mediumPage
     *
     * @return SocialMediaLinks
     */
    public function setMediumPage($mediumPage = null)
    {
        $this->mediumPage = $mediumPage;

        return $this;
    }

    /**
     * Get mediumPage.
     *
     * @return string|null
     */
    public function getMediumPage()
    {
        return $this->mediumPage;
    }

    /**
     * Set steemitPage.
     *
     * @param string|null $steemitPage
     *
     * @return SocialMediaLinks
     */
    public function setSteemitPage($steemitPage = null)
    {
        $this->steemitPage = $steemitPage;

        return $this;
    }

    /**
     * Get steemitPage.
     *
     * @return string|null
     */
    public function getSteemitPage()
    {
        return $this->steemitPage;
    }

    /**
     * Set discordPage.
     *
     * @param string|null $discordPage
     *
     * @return SocialMediaLinks
     */
    public function setDiscordPage($discordPage = null)
    {
        $this->discordPage = $discordPage;

        return $this;
    }

    /**
     * Get discordPage.
     *
     * @return string|null
     */
    public function getDiscordPage()
    {
        return $this->discordPage;
    }

    /**
     * @param Ico $ico
     * @return self
     */
    public function setIco($ico)
    {
        $this->ico = $ico;
        return $this;
    }

    /**
     * @return Ico
     */
    public function getIco()
    {
        return $this->ico;
    }

    /**
     * @return string
     */
    public function getWebsiteLink()
    {
        return $this->websiteLink;
    }

    /**
     * @param string $websiteLink
     * @return self
     */
    public function setWebsiteLink($websiteLink)
    {
        $this->websiteLink = $websiteLink;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getVideoPresentetion()
    {
        return $this->videoPresentetion;
    }

    /**
     * @param string $videoPresentetion
     * @return self
     */
    public function setVideoPresentetion($videoPresentetion)
    {
        $this->videoPresentetion = $videoPresentetion;
        return $this;
    }

    /**
     * @return string
     */
    public function getAirdrops()
    {
        return $this->airdrops;
    }

    /**
     * @param mixed $airdrops
     * @return self
     */
    public function setAirdrops($airdrops)
    {
        $this->airdrops = $airdrops;
        return $this;
    }

    /**
     * @return string
     */
    public function getBounties()
    {
        return $this->bounties;
    }

    /**
     * @param string $bounties
     * @return self
     */
    public function setBounties($bounties)
    {
        $this->bounties = $bounties;
        return $this;
    }
}
