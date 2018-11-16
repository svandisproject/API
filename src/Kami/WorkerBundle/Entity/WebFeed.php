<?php

namespace Kami\WorkerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kami\ApiCoreBundle\Annotation as Api;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * WebFeed
 *
 * @ORM\Table(name="web_feed")
 * @ORM\Entity(repositoryClass="Kami\WorkerBundle\Repository\WebFeedRepository")
 * @UniqueEntity("title")
 * @UniqueEntity("url")
 * @Api\Access({"ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
 */
class WebFeed
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
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, unique=true)
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="link_selector", type="string", length=255)
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     */
    private $linkSelector;

    /**
     * @var int
     *
     * @ORM\Column(name="time_interval", type="integer")
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     */
    private $timeInterval;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=true)
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     */
    private $enabled = true;

    /**
     * @ORM\OneToOne(targetEntity="Kami\WorkerBundle\Entity\Stat", mappedBy="webFeed", cascade={"persist"})
     * @Api\Relation()
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $stat;

    /**
     * @return Stat
     */
    public function getStat(): ?Stat
    {
        return $this->stat;
    }

    /**
     * @param Stat $stat
     *
     * @return self
     */
    public function setStat($stat): self
    {
        $this->stat = $stat;

        return $this;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return WebFeed
     */
    public function setTitle(string $title) : WebFeed
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle() : ?string
    {
        return $this->title;
    }

    /**
     * Set url.
     *
     * @param string $url
     *
     * @return WebFeed
     */
    public function setUrl($url) : WebFeed
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl() : ?string
    {
        return $this->url;
    }

    /**
     * Set linkSelector.
     *
     * @param string $linkSelector
     *
     * @return WebFeed
     */
    public function setLinkSelector($linkSelector) : WebFeed
    {
        $this->linkSelector = $linkSelector;

        return $this;
    }

    /**
     * Get linkSelector.
     *
     * @return string
     */
    public function getLinkSelector() : ?string
    {
        return $this->linkSelector;
    }

    /**
     * @return int
     */
    public function getTimeInterval(): ?int
    {
        return $this->timeInterval;
    }

    /**
     * @param int $timeInterval
     * @return WebFeed
     */
    public function setTimeInterval(int $timeInterval): WebFeed
    {
        $this->timeInterval = $timeInterval;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     * @return self
     */
    public function setEnabled(bool $enabled = true): self
    {
        $this->enabled = $enabled;

        return $this;
    }


}
