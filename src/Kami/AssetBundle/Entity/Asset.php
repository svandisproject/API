<?php

namespace Kami\AssetBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Kami\IcoBundle\Entity\Ico;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Kami\ApiCoreBundle\Annotation as Api;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\MaxDepth;

/**
 * Asset
 *
 * @ORM\Entity(repositoryClass="Kami\AssetBundle\Repository\AssetRepository")
 * @ORM\Table(name="asset")
 * @UniqueEntity({"ticker"})
 * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
 * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
 */
class Asset
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     *
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="ticker", type="string", length=25)
     * @Assert\NotBlank()
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $ticker;

    /**
     * @ORM\Column(name="price", type="decimal", precision=25, scale=15, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\AssetBundle\Entity\TokenType", inversedBy="assets")
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $tokenType;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\AssetBundle\Entity\TokenTypeStandard", inversedBy="assets")
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $tokenTypeStandard;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\ContentBundle\Entity\Post", inversedBy="assets")
     * @ORM\JoinTable(name="asset_posts")
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\Relation()
     */
    private $posts;

    /**
     * @ORM\Column(name="convertable", type="boolean")
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $convertable = false;

    /**
     * @ORM\OneToMany(targetEntity="Kami\AssetBundle\Entity\Volume", mappedBy="asset")
     */
    private $volumes;

    /**
     * @ORM\OneToOne(targetEntity="Kami\IcoBundle\Entity\Ico", inversedBy="asset")
     * @ORM\JoinColumn(name="ico_id", referencedColumnName="id")
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\Relation()
     * @MaxDepth(2)
     */
    private $ico;

    /**
     * @ORM\OneToOne(targetEntity="Kami\AssetBundle\Entity\MarketCap", inversedBy="asset", cascade={"persist"})
     * @ORM\JoinColumn(name="market_cap_id", referencedColumnName="id")
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\Relation()
     */
    private $marketCap;

    /**
     * @ORM\Column(name="change", type="float", nullable=true)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $change;

    /**
     * @ORM\Column(name="weekly_change", type="float", nullable=true)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $weeklyChange;

    /**
     * @ORM\Column(name="year_to_day_change", type="float", nullable=true)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $yearToDayChange;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->volumes = new ArrayCollection();
    }

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
     * @return Asset
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
     * Set ticker.
     *
     * @param string $ticker
     *
     * @return Asset
     */
    public function setTicker($ticker)
    {
        $this->ticker = $ticker;

        return $this;
    }

    /**
     * Get ticker.
     *
     * @return string
     */
    public function getTicker()
    {
        return $this->ticker;
    }

    /**
     * Set price.
     *
     * @param int $price
     *
     * @return Asset
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price.
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set tokenType.
     *
     * @param \Kami\AssetBundle\Entity\TokenType|null $tokenType
     *
     * @return Asset
     */
    public function setTokenType(\Kami\AssetBundle\Entity\TokenType $tokenType = null)
    {
        $this->tokenType = $tokenType;

        return $this;
    }

    /**
     * Get tokenType.
     *
     * @return \Kami\AssetBundle\Entity\TokenType|null
     */
    public function getTokenType()
    {
        return $this->tokenType;
    }

    /**
     * Add post.
     *
     * @param \Kami\ContentBundle\Entity\Post $post
     *
     * @return Asset
     */
    public function addPost(\Kami\ContentBundle\Entity\Post $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove post.
     *
     * @param \Kami\ContentBundle\Entity\Post $post
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePost(\Kami\ContentBundle\Entity\Post $post)
    {
        return $this->posts->removeElement($post);
    }

    /**
     * Get posts.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @return boolean
     */
    public function getConvertable()
    {
        return $this->convertable;
    }

    /**
     * @param boolean $convertable
     */
    public function setConvertable($convertable)
    {
        $this->convertable = $convertable;
    }

    /**
     * Add volume.
     *
     * @param \Kami\AssetBundle\Entity\Volume $volume
     *
     * @return Asset
     */
    public function addVolume(\Kami\AssetBundle\Entity\Volume $volume)
    {
        $this->volumes[] = $volume;

        return $this;
    }

    /**
     * Remove volume.
     *
     * @param \Kami\AssetBundle\Entity\Volume $volume
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeVolume(\Kami\AssetBundle\Entity\Volume $volume)
    {
        return $this->volumes->removeElement($volume);
    }

    /**
     * Get volumes.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVolumes()
    {
        return $this->volumes;
    }

    /**
     * @param Ico $ico
     *
     * @return self
     */
    public function setIco($ico): self
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
     * @param $marketCap
     *
     * @return self
     */
    public function setMarketCap($marketCap)
    {
        $this->marketCap = $marketCap;

        return $this;
    }

    /**
     * @return MarketCap
     */
    public function getMarketCap()
    {
        return $this->marketCap;
    }

    /**
     * @return float
     */
    public function getChange()
    {
        return $this->change;
    }

    /**
     * @param float $change
     */
    public function setChange($change): void
    {
        $this->change = $change;
    }

    /**
     * @return float
     */
    public function getWeeklyChange()
    {
        return $this->weeklyChange;
    }

    /**
     * @param float $weeklyChange
     */
    public function setWeeklyChange($weeklyChange): void
    {
        $this->weeklyChange = $weeklyChange;
    }

    /**
     * @return float
     */
    public function getYearToDayChange()
    {
        return $this->yearToDayChange;
    }

    /**
     * @param float $yearToDayChange
     */
    public function setYearToDayChange($yearToDayChange): void
    {
        $this->yearToDayChange = $yearToDayChange;
    }

    /**
     * @return ArrayCollection
     */
    public function getTokenTypeStandard()
    {
        return $this->tokenTypeStandard;
    }

    /**
     * @param string $tokenTypeStandard
     */
    public function setTokenTypeStandard($tokenTypeStandard)
    {
        $this->tokenTypeStandard[] = $tokenTypeStandard;
    }

}
