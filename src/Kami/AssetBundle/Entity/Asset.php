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
 * @Api\AnonymousAccess()
 * @Api\AnonymousCreate()
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
     * @Api\AnonymousAccess()
     * @Api\AnonymousCreate()
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
     * @Api\AnonymousAccess()
     * @Api\AnonymousCreate()
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
     * @Api\AnonymousAccess()
     * @Api\AnonymousCreate()
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
     * @Api\AnonymousAccess()
     * @Api\AnonymousCreate()
     * @ORM\Column(name="price_usd", type="float", nullable=true)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $priceUsd;

    /**
     * @var float
     *
     * @Api\AnonymousAccess()
     * @Api\AnonymousCreate()
     * @ORM\Column(name="price_btc", type="float", nullable=true)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $priceBtc;

    /**
     * @var float
     *
     * @Api\AnonymousAccess()
     * @Api\AnonymousCreate()
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
     * @Api\AnonymousAccess()
     * @Api\AnonymousCreate()
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
     * @Api\AnonymousAccess()
     * @Api\AnonymousCreate()
     * @ORM\Column(name="available_supply", type="float", nullable=true)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $availableSupply;

    /**
     * @var float
     *
     * @Api\AnonymousCreate()
     * @Api\AnonymousAccess()
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
     * @Api\AnonymousAccess()
     * @Api\AnonymousCreate()
     * @ORM\Column(name="max_supply", type="float", nullable=true)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $maxSupply;

    /**
     * @var float
     *
     * @Api\AnonymousAccess()
     * @Api\AnonymousCreate()
     * @ORM\Column(name="percent_change_hour", type="float", nullable=true)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $percentChangeHour;

    /**
     * @var float
     *
     * @Api\AnonymousAccess()
     * @Api\AnonymousCreate()
     * @ORM\Column(name="percent_change_day", type="float", nullable=true)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $percentChangeDay;

    /**
     * @var float
     *
     * @Api\AnonymousAccess()
     * @Api\AnonymousCreate()
     * @ORM\Column(name="percent_change_week", type="float", nullable=true)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $percentChangeWeek;

    /**
     * @var \DateTime
     *
     * @Api\AnonymousAccess()
     * @Api\AnonymousCreate()
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
     * Set priceUsd.
     *
     * @param float $priceUsd
     *
     * @return Asset
     */
    public function setPriceUsd($priceUsd)
    {
        $this->priceUsd = $priceUsd;

        return $this;
    }

    /**
     * Get priceUsd.
     *
     * @return float
     */
    public function getPriceUsd()
    {
        return $this->priceUsd;
    }

    /**
     * Set priceBtc.
     *
     * @param float $priceBtc
     *
     * @return Asset
     */
    public function setPriceBtc($priceBtc)
    {
        $this->priceBtc = $priceBtc;

        return $this;
    }

    /**
     * Get priceBtc.
     *
     * @return float
     */
    public function getPriceBtc()
    {
        return $this->priceBtc;
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
     * Set availableSupply.
     *
     * @param float $availableSupply
     *
     * @return Asset
     */
    public function setAvailableSupply($availableSupply)
    {
        $this->availableSupply = $availableSupply;

        return $this;
    }

    /**
     * Get availableSupply.
     *
     * @return float
     */
    public function getAvailableSupply()
    {
        return $this->availableSupply;
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
     * Set percentChangeHour.
     *
     * @param float $percentChangeHour
     *
     * @return Asset
     */
    public function setPercentChangeHour($percentChangeHour)
    {
        $this->percentChangeHour = $percentChangeHour;

        return $this;
    }

    /**
     * Get percentChangeHour.
     *
     * @return float
     */
    public function getPercentChangeHour()
    {
        return $this->percentChangeHour;
    }

    /**
     * Set percentChangeDay.
     *
     * @param float $percentChangeDay
     *
     * @return Asset
     */
    public function setPercentChangeDay($percentChangeDay)
    {
        $this->percentChangeDay = $percentChangeDay;

        return $this;
    }

    /**
     * Get percentChangeDay.
     *
     * @return float
     */
    public function getPercentChangeDay()
    {
        return $this->percentChangeDay;
    }

    /**
     * Set percentChangeWeek.
     *
     * @param float $percentChangeWeek
     *
     * @return Asset
     */
    public function setPercentChangeWeek($percentChangeWeek)
    {
        $this->percentChangeWeek = $percentChangeWeek;

        return $this;
    }

    /**
     * Get percentChangeWeek.
     *
     * @return float
     */
    public function getPercentChangeWeek()
    {
        return $this->percentChangeWeek;
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
