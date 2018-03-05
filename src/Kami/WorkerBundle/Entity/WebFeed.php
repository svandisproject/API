<?php

namespace Kami\WorkerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebFeed
 *
 * @ORM\Table(name="web_feed")
 * @ORM\Entity(repositoryClass="Kami\WorkerBundle\Repository\WebFeedRepository")
 */
class WebFeed
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
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, unique=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="titleSelector", type="string", length=255)
     */
    private $titleSelector;

    /**
     * @var string
     *
     * @ORM\Column(name="contentSelector", type="string", length=255)
     */
    private $contentSelector;

    /**
     * @var string
     *
     * @ORM\Column(name="publishedAtSelector", type="string", length=255)
     */
    private $publishedAtSelector;

    /**
     * @var string
     *
     * @ORM\Column(name="dateFormat", type="string", length=255, nullable=true)
     */
    private $dateFormat;


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
     * Set title.
     *
     * @param string $title
     *
     * @return WebFeed
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return WebFeed
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Set titleSelector.
     *
     * @param string $titleSelector
     *
     * @return WebFeed
     */
    public function setTitleSelector($titleSelector)
    {
        $this->titleSelector = $titleSelector;

        return $this;
    }

    /**
     * Get titleSelector.
     *
     * @return string
     */
    public function getTitleSelector()
    {
        return $this->titleSelector;
    }

    /**
     * Set contentSelector.
     *
     * @param string $contentSelector
     *
     * @return WebFeed
     */
    public function setContentSelector($contentSelector)
    {
        $this->contentSelector = $contentSelector;

        return $this;
    }

    /**
     * Get contentSelector.
     *
     * @return string
     */
    public function getContentSelector()
    {
        return $this->contentSelector;
    }

    /**
     * Set publishedAtSelector.
     *
     * @param string $publishedAtSelector
     *
     * @return WebFeed
     */
    public function setPublishedAtSelector($publishedAtSelector)
    {
        $this->publishedAtSelector = $publishedAtSelector;

        return $this;
    }

    /**
     * Get publishedAtSelector.
     *
     * @return string
     */
    public function getPublishedAtSelector()
    {
        return $this->publishedAtSelector;
    }

    /**
     * Set dateFormat.
     *
     * @param string $dateFormat
     *
     * @return WebFeed
     */
    public function setDateFormat($dateFormat)
    {
        $this->dateFormat = $dateFormat;

        return $this;
    }

    /**
     * Get dateFormat.
     *
     * @return string
     */
    public function getDateFormat()
    {
        return $this->dateFormat;
    }

}
