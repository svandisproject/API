<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SocialMedia
 *
 * @ORM\Table(name="social_media")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\SocialMediaRepository")
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
     * @var string|null
     *
     * @ORM\Column(name="linked_in", type="string", length=255, nullable=true)
     */
    private $linkedIn;

    /**
     * @var string|null
     *
     * @ORM\Column(name="twitter", type="string", length=255, nullable=true)
     */
    private $twitter;

    /**
     * @var string|null
     *
     * @ORM\Column(name="medium", type="string", length=255, nullable=true)
     */
    private $medium;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telegram", type="string", length=255, nullable=true)
     */
    private $telegram;

    /**
     * @var string|null
     *
     * @ORM\Column(name="discord", type="string", length=255, nullable=true)
     */
    private $discord;

    /**
     * @var string|null
     *
     * @ORM\Column(name="facebook", type="string", length=255, nullable=true)
     */
    private $facebook;

    /**
     * @var string|null
     *
     * @ORM\Column(name="reddit", type="string", length=255, nullable=true)
     */
    private $reddit;

    /**
     * @ORM\OneToOne(targetEntity="Kami\IcoBundle\Entity\Person", inversedBy="social_media_links")
     */
    private $person;


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
     * Set linkedIn.
     *
     * @param string|null $linkedIn
     *
     * @return SocialMedia
     */
    public function setLinkedIn($linkedIn = null)
    {
        $this->linkedIn = $linkedIn;

        return $this;
    }

    /**
     * Get linkedIn.
     *
     * @return string|null
     */
    public function getLinkedIn()
    {
        return $this->linkedIn;
    }

    /**
     * Set twitter.
     *
     * @param string|null $twitter
     *
     * @return SocialMedia
     */
    public function setTwitter($twitter = null)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter.
     *
     * @return string|null
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set medium.
     *
     * @param string|null $medium
     *
     * @return SocialMedia
     */
    public function setMedium($medium = null)
    {
        $this->medium = $medium;

        return $this;
    }

    /**
     * Get medium.
     *
     * @return string|null
     */
    public function getMedium()
    {
        return $this->medium;
    }

    /**
     * Set telegram.
     *
     * @param string|null $telegram
     *
     * @return SocialMedia
     */
    public function setTelegram($telegram = null)
    {
        $this->telegram = $telegram;

        return $this;
    }

    /**
     * Get telegram.
     *
     * @return string|null
     */
    public function getTelegram()
    {
        return $this->telegram;
    }

    /**
     * Set discord.
     *
     * @param string|null $discord
     *
     * @return SocialMedia
     */
    public function setDiscord($discord = null)
    {
        $this->discord = $discord;

        return $this;
    }

    /**
     * Get discord.
     *
     * @return string|null
     */
    public function getDiscord()
    {
        return $this->discord;
    }

    /**
     * Set facebook.
     *
     * @param string|null $facebook
     *
     * @return SocialMedia
     */
    public function setFacebook($facebook = null)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook.
     *
     * @return string|null
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set reddit.
     *
     * @param string|null $reddit
     *
     * @return SocialMedia
     */
    public function setReddit($reddit = null)
    {
        $this->reddit = $reddit;

        return $this;
    }

    /**
     * Get reddit.
     *
     * @return string|null
     */
    public function getReddit()
    {
        return $this->reddit;
    }

    /**
     * @return Person
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @param Person $person
     * @return self
     */
    public function setPerson($person): self
    {
        $this->person = $person;
        return $this;
    }
}
