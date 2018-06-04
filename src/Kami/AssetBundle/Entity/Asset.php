<?php

namespace Kami\AssetBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Kami\ContentBundle\Entity\Post;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Kami\ApiCoreBundle\Annotation as Api;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Asset
 *
 * @ORM\Entity
 * @ORM\Table(name="asset")
 * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
 * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
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
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="symbol", type="string", length=255)
     * @Assert\NotBlank()
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $symbol;

    /**
     * @var int
     *
     * @ORM\Column(name="rank", type="integer", nullable=true)
     * @Assert\NotBlank()
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $rank;

    /**
     * @var float
     *
     * @ORM\Column(name="circulating_supply", type="float", nullable=true)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $circulatingSupply;

    /**
     * @var float
     *
     * @ORM\Column(name="total_supply", type="float", nullable=true)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $totalSupply;

    /**
     * @var float
     *
     * @ORM\Column(name="max_supply", type="float", nullable=true)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $maxSupply;

    /**
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @ORM\OneToOne(targetEntity="Kami\AssetBundle\Entity\Price", mappedBy="asset", cascade={"persist"})
     * @ORM\JoinColumn(name="price_id", referencedColumnName="id")
     */
    private $price;

    /**
     * @var float
     *
     * @ORM\Column(name="volume_usd_day", type="float", nullable=true)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $volumeUsdDay;

    /**
     * @var float
     *
     * @ORM\Column(name="market_cap_usd", type="float", nullable=true)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $marketCapUsd;

    /**
     * @var float
     *
     * @ORM\Column(name="percent_change_hour_usd", type="float", nullable=true)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $percentChangeHourUsd;

    /**
     * @var float
     *
     * @ORM\Column(name="percent_change_day_usd", type="float", nullable=true)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $percentChangeDayUsd;

    /**
     * @var float
     *
     * @ORM\Column(name="percent_change_week_usd", type="float", nullable=true)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $percentChangeWeekUsd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_updated", type="datetime")
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $lastUpdated;



    /**
     * @ORM\ManyToMany(targetEntity="Kami\ContentBundle\Entity\Post", inversedBy="assets")
     * @ORM\JoinTable(name="assets_posts")
     */
    private $posts;

    public function __construct() {
        $this->posts = new ArrayCollection();
    }

    /**
     * Add post.
     *
     * @param Post $post
     *
     * @return Asset
     */
    public function addPost(Post $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove post.
     *
     * @param Post $post
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePost(Post $post)
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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Asset
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set symbol.
     *
     * @param string $symbol
     *
     * @return Asset
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;

        return $this;
    }

    /**
     * Get symbol.
     *
     * @return string
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * Set rank.
     *
     * @param integer $rank
     *
     * @return Asset
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank.
     *
     * @return integer
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * set price.
     *
     * @param $price
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
     * @return Price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set volumeUsdDay.
     *
     * @param float $volumeUsdDay
     *
     * @return Asset
     */
    public function setVolumeUsdDay($volumeUsdDay)
    {
        $this->volumeUsdDay = $volumeUsdDay;

        return $this;
    }

    /**
     * Get volumeUsdDay.
     *
     * @return float
     */
    public function getVolumeUsdDay()
    {
        return $this->volumeUsdDay;
    }

    /**
     * Set marketCapUsd.
     *
     * @param float $marketCapUsd
     *
     * @return Asset
     */
    public function setMarketCapUsd($marketCapUsd)
    {
        $this->marketCapUsd = $marketCapUsd;

        return $this;
    }

    /**
     * Get marketCapUsd.
     *
     * @return float
     */
    public function getMarketCapUsd()
    {
        return $this->marketCapUsd;
    }

    /**
     * Set circulatingSupply.
     *
     * @param float $circulatingSupply
     *
     * @return Asset
     */
    public function setCirculatingSupply($circulatingSupply)
    {
        $this->circulatingSupply = $circulatingSupply;

        return $this;
    }

    /**
     * Get circulatingSupply.
     *
     * @return float
     */
    public function getCirculatingSupply()
    {
        return $this->circulatingSupply;
    }

    /**
     * Set totalSupply.
     *
     * @param float $totalSupply
     *
     * @return Asset
     */
    public function setTotalSupply($totalSupply)
    {
        $this->totalSupply = $totalSupply;

        return $this;
    }

    /**
     * Get totalSupply.
     *
     * @return float
     */
    public function getTotalSupply()
    {
        return $this->totalSupply;
    }

    /**
     * Set maxSupply.
     *
     * @param float $maxSupply
     *
     * @return Asset
     */
    public function setMaxSupply($maxSupply)
    {
        $this->maxSupply = $maxSupply;

        return $this;
    }

    /**
     * Get maxSupply.
     *
     * @return float
     */
    public function getMaxSupply()
    {
        return $this->maxSupply;
    }

    /**
     * Set percentChangeHourUsd.
     *
     * @param float $percentChangeHourUsd
     *
     * @return Asset
     */
    public function setPercentChangeHourUsd($percentChangeHourUsd)
    {
        $this->percentChangeHourUsd = $percentChangeHourUsd;

        return $this;
    }

    /**
     * Get percentChangeHourUsd.
     *
     * @return float
     */
    public function getPercentChangeHourUsd()
    {
        return $this->percentChangeHourUsd;
    }

    /**
     * Set percentChangeDayUsd.
     *
     * @param float $percentChangeDayUsd
     *
     * @return Asset
     */
    public function setPercentChangeDayUsd($percentChangeDayUsd)
    {
        $this->percentChangeDayUsd = $percentChangeDayUsd;

        return $this;
    }

    /**
     * Get percentChangeDayUsd.
     *
     * @return float
     */
    public function getPercentChangeDayUsd()
    {
        return $this->percentChangeDayUsd;
    }

    /**
     * Set percentChangeWeekUsd.
     *
     * @param float $percentChangeWeekUsd
     *
     * @return Asset
     */
    public function setPercentChangeWeekUsd($percentChangeWeekUsd)
    {
        $this->percentChangeWeekUsd = $percentChangeWeekUsd;

        return $this;
    }

    /**
     * Get percentChangeWeekUsd.
     *
     * @return float
     */
    public function getPercentChangeWeekUsd()
    {
        return $this->percentChangeWeekUsd;
    }

    /**
     * Set lastUpdated.
     *
     * @param int $lastUpdated
     *
     * @return Asset
     */
    public function setLastUpdated($lastUpdated)
    {
        $this->lastUpdated = (new \DateTime())->setTimestamp($lastUpdated);
        return $this;
    }

    /**
     * Get lastUpdated.
     *
     * @return \DateTime
     */
    public function getLastUpdated()
    {
        return $this->lastUpdated;
    }
}
