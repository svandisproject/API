<?php


namespace Kami\AssetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kami\ApiCoreBundle\Annotation as Api;

/**
 * Class TradableToken
 *
 * @ORM\Entity(repositoryClass="Kami\AssetBundle\Repository\TradableTokenRepository")
 * @ORM\Table(name="tradable_token")
 * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
 */
class TradableToken
{
    /**
     * @var float
     *
     * @ORM\Column(name="change", type="decimal", precision=25, scale=15, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $change;

    /**
     * @var float
     *
     * @ORM\Column(name="weekly_change", type="decimal", precision=25, scale=15, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $weeklyChange;

    /**
     * @var float
     *
     * @ORM\Column(name="year_to_day_change", type="decimal", precision=25, scale=15, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $yearToDayChange;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="Kami\AssetBundle\Entity\Asset", mappedBy="tradableToken")
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $asset;

    /**
     * @var string
     *
     * @ORM\Column(name="ticker", type="string", length=25)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $ticker;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="algorithm", type="string", length=25, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $algorithm;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=25, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="integer", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="sector", type="string", length=25, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $sector;

    /**
     * @var integer
     *
     * @ORM\Column(name="ico_amount", type="integer", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $icoAmount;

    /**
     * @var float
     *
     * @ORM\Column(name="return_on_ico", type="decimal", precision=25, scale=15, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $returnOnIco;

    /**
     * @var float
     *
     * @ORM\Column(name="market_cap", type="decimal", precision=35, scale=15, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $marketCap;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="decimal", precision=25, scale=15, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $price;

    /**
     * @var float
     *
     * @ORM\Column(name="last_price", type="decimal", precision=25, scale=15, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $lastPrice;

    /**
     * @var float
     *
     * @ORM\Column(name="initial_price", type="decimal", precision=25, scale=15, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $initialPrice;

    /**
     * @var float
     *
     * @ORM\Column(name="price_change_percent", type="decimal", precision=25, scale=15, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $priceChangePercent;

    /**
     * @var float
     *
     * @ORM\Column(name="price_change_hour", type="decimal", precision=25, scale=15, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $priceChangeHour;

    /**
     * @var float
     *
     * @ORM\Column(name="price_change_day", type="decimal", precision=25, scale=15, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $priceChangeDay;

    /**
     * @var float
     *
     * @ORM\Column(name="price_change_month", type="decimal", precision=25, scale=15, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $priceChangeMonth;

    /**
     * @var float
     *
     * @ORM\Column(name="price_change_six_month", type="decimal", precision=25, scale=15, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $priceChangeSixMonth;

    /**
     * @var integer
     *
     * @ORM\Column(name="circulating_supply", type="bigint", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $circulatingSupply;

    /**
     * @var integer
     *
     * @ORM\Column(name="max_supply", type="bigint", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $maxSupply;

    /**
     * @var float
     *
     * @ORM\Column(name="volume", type="decimal", precision=25, scale=15, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $volume;

    /**
     * @var float
     *
     * @ORM\Column(name="volume_day", type="decimal", precision=25, scale=15, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $volumeDay;

    /**
     * @var float
     *
     * @ORM\Column(name="avg_volume_weeks52", type="decimal", precision=25, scale=15, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $avgVolumeWeeks52;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="text", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $twitter;

    /**
     * @var string
     *
     * @ORM\Column(name="telegramm", type="text", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $telegramm;

    /**
     * @var string
     *
     * @ORM\Column(name="reddit", type="text", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $reddit;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="text", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $facebook;

    /**
     * @var string
     *
     * @ORM\Column(name="medium", type="text", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $medium;

    /**
     * @var string
     *
     * @ORM\Column(name="steemit", type="text", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $steemit;

    /**
     * @var string
     *
     * @ORM\Column(name="discord", type="text", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $discord;

    /**
     * @var integer
     *
     * @ORM\Column(name="medium_followers", type="integer", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $mediumFollowers;

    /**
     * @var integer
     *
     * @ORM\Column(name="telegramm_followers", type="integer", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $telegrammFollowers;

    /**
     * @var integer
     *
     * @ORM\Column(name="twitter_followers", type="integer", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $twitterFollowers;

    /**
     * @var integer
     *
     * @ORM\Column(name="reddit_subscriber", type="integer", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $redditSubscriber;

    /**
     * @return int|null
     */
    public function getAge(): ?int
    {
        return $this->age;
    }

    /**
     * @param int|null $age
     * @return self
     */
    public function setAge(?int $age): self
    {
        $this->age = $age;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAlgorithm(): ?string
    {
        return $this->algorithm;
    }

    /**
     * @param string|null $algorithm
     * @return self
     */
    public function setAlgorithm(?string $algorithm): self
    {
        $this->algorithm = $algorithm;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getAvgVolumeWeeks52(): ?float
    {
        return $this->avgVolumeWeeks52;
    }

    /**
     * @param float|null $avgVolumeWeeks52
     * @return self
     */
    public function setAvgVolumeWeeks52(?float $avgVolumeWeeks52): self
    {
        $this->avgVolumeWeeks52 = $avgVolumeWeeks52;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCirculatingSupply(): ?int
    {
        return $this->circulatingSupply;
    }

    /**
     * @param int|null $circulatingSupply
     * @return self
     */
    public function setCirculatingSupply(?int $circulatingSupply): self
    {
        $this->circulatingSupply = $circulatingSupply;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDiscord(): ?string
    {
        return $this->discord;
    }

    /**
     * @param string|null $discord
     * @return self
     */
    public function setDiscord(?string $discord): self
    {
        $this->discord = $discord;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    /**
     * @param string|null $facebook
     * @return self
     */
    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getIcoAmount(): ?int
    {
        return $this->icoAmount;
    }

    /**
     * @param int|null $icoAmount
     * @return self
     */
    public function setIcoAmount(?int $icoAmount): self
    {
        $this->icoAmount = $icoAmount;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getInitialPrice(): ?float
    {
        return $this->initialPrice;
    }

    /**
     * @param float|null $initialPrice
     * @return self
     */
    public function setInitialPrice(?float $initialPrice): self
    {
        $this->initialPrice = $initialPrice;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getLastPrice(): ?float
    {
        return $this->lastPrice;
    }

    /**
     * @param float|null $lastPrice
     * @return self
     */
    public function setLastPrice($lastPrice): ?self
    {
        $this->lastPrice = $lastPrice;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getMarketCap(): ?float
    {
        return $this->marketCap;
    }

    /**
     * @param float|null $marketCap
     * @return self
     */
    public function setMarketCap(?float $marketCap): self
    {
        $this->marketCap = $marketCap;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMaxSupply(): ?int
    {
        return $this->maxSupply;
    }

    /**
     * @param int|null $maxSupply
     * @return self
     */
    public function setMaxSupply(?int $maxSupply): self
    {
        $this->maxSupply = $maxSupply;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMedium(): ?string
    {
        return $this->medium;
    }

    /**
     * @param string|null $medium
     * @return self
     */
    public function setMedium(?string $medium): self
    {
        $this->medium = $medium;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMediumFollowers(): ?int
    {
        return $this->mediumFollowers;
    }

    /**
     * @param int|null $mediumFollowers
     * @return self
     */
    public function setMediumFollowers(?int $mediumFollowers): self
    {
        $this->mediumFollowers = $mediumFollowers;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     * @return self
     */
    public function setPrice(?float $price): self
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPriceChangeDay(): ?float
    {
        return $this->priceChangeDay;
    }

    /**
     * @param float|null $priceChangeDay
     * @return self
     */
    public function setPriceChangeDay(?float $priceChangeDay): self
    {
        $this->priceChangeDay = $priceChangeDay;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPriceChangeHour(): ?float
    {
        return $this->priceChangeHour;
    }

    /**
     * @param float|null $priceChangeHour
     * @return self
     */
    public function setPriceChangeHour(?float $priceChangeHour): self
    {
        $this->priceChangeHour = $priceChangeHour;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPriceChangeMonth(): ?float
    {
        return $this->priceChangeMonth;
    }

    /**
     * @param float|null $priceChangeMonth
     * @return self
     */
    public function setPriceChangeMonth(?float $priceChangeMonth): self
    {
        $this->priceChangeMonth = $priceChangeMonth;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPriceChangePercent(): ?float
    {
        return $this->priceChangePercent;
    }

    /**
     * @param float|null $priceChangePercent
     * @return self
     */
    public function setPriceChangePercent(?float $priceChangePercent): self
    {
        $this->priceChangePercent = $priceChangePercent;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPriceChangeSixMonth(): ?float
    {
        return $this->priceChangeSixMonth;
    }

    /**
     * @param float|null $priceChangeSixMonth
     * @return self
     */
    public function setPriceChangeSixMonth($priceChangeSixMonth): self
    {
        $this->priceChangeSixMonth = $priceChangeSixMonth;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getReddit(): ?string
    {
        return $this->reddit;
    }

    /**
     * @param string|null $reddit
     * @return self
     */
    public function setReddit(?string $reddit): self
    {
        $this->reddit = $reddit;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getRedditSubscriber(): ?int
    {
        return $this->redditSubscriber;
    }

    /**
     * @param int|null $redditSubscriber
     * @return self
     */
    public function setRedditSubscriber(?int $redditSubscriber): self
    {
        $this->redditSubscriber = $redditSubscriber;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getReturnOnIco(): ?float
    {
        return $this->returnOnIco;
    }

    /**
     * @param float|null $returnOnIco
     * @return self
     */
    public function setReturnOnIco(?float $returnOnIco): self
    {
        $this->returnOnIco = $returnOnIco;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSector(): ?string
    {
        return $this->sector;
    }

    /**
     * @param string|null $sector
     * @return self
     */
    public function setSector(?string $sector): self
    {
        $this->sector = $sector;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSteemit(): ?string
    {
        return $this->steemit;
    }

    /**
     * @param string|null $steemit
     */
    public function setSteemit($steemit): void
    {
        $this->steemit = $steemit;
    }

    /**
     * @return string|null
     */
    public function getTelegramm(): ?string
    {
        return $this->telegramm;
    }

    /**
     * @param string|null $telegramm
     */
    public function setTelegramm($telegramm): void
    {
        $this->telegramm = $telegramm;
    }

    /**
     * @return int|null
     */
    public function getTelegrammFollowers(): ?int
    {
        return $this->telegrammFollowers;
    }

    /**
     * @param int|null $telegrammFollowers
     */
    public function setTelegrammFollowers($telegrammFollowers): void
    {
        $this->telegrammFollowers = $telegrammFollowers;
    }

    /**
     * @return string|null
     */
    public function getTicker(): ?string
    {
        return $this->ticker;
    }

    /**
     * @param string|null $ticker
     */
    public function setTicker($ticker): void
    {
        $this->ticker = $ticker;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    /**
     * @param string|null $twitter
     */
    public function setTwitter($twitter): void
    {
        $this->twitter = $twitter;
    }

    /**
     * @return int|null
     */
    public function getTwitterFollowers(): ?int
    {
        return $this->twitterFollowers;
    }

    /**
     * @param int|null $twitterFollowers
     */
    public function setTwitterFollowers($twitterFollowers): void
    {
        $this->twitterFollowers = $twitterFollowers;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return float|null
     */
    public function getVolume(): ?float
    {
        return $this->volume;
    }

    /**
     * @param float|null $volume
     */
    public function setVolume($volume): void
    {
        $this->volume = $volume;
    }

    /**
     * @return float|null
     */
    public function getVolumeDay(): ?float
    {
        return $this->volumeDay;
    }

    /**
     * @param float|null $volumeDay
     */
    public function setVolumeDay($volumeDay): void
    {
        $this->volumeDay = $volumeDay;
    }

    /**
     * @return mixed
     */
    public function getAsset()
    {
        return $this->asset;
    }

    /**
     * @param mixed $asset
     * @return self
     */
    public function setAsset($asset): self
    {
        $this->asset = $asset;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return float | null
     */
    public function getChange(): ?float
    {
        return $this->change;
    }

    /**
     * @param float | null $change
     * @return self
     */
    public function setChange(?float $change): self
    {
        $this->change = $change;
        return $this;
    }

    /**
     * @return float | null
     */
    public function getWeeklyChange(): ?float
    {
        return $this->weeklyChange;
    }

    /**
     * @param float|null $weeklyChange
     * @return self
     */
    public function setWeeklyChange(?float $weeklyChange): self
    {
        $this->weeklyChange = $weeklyChange;
        return $this;
    }

    /**
     * @return float | null
     */
    public function getYearToDayChange(): ?float
    {
        return $this->yearToDayChange;
    }

    /**
     * @param float|null $yearToDayChange
     * @return self
     */
    public function setYearToDayChange(?float $yearToDayChange): self
    {
        $this->yearToDayChange = $yearToDayChange;
        return $this;
    }
}