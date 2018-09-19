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
     * @ORM\Column(name="market_cap", type="decimal", precision=25, scale=15, nullable=true)
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
     * @ORM\Column(name="price_change_week", type="decimal", precision=25, scale=15, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $priceChangeWeek;

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
     * @var float
     *
     * @ORM\Column(name="price_change_year", type="decimal", precision=25, scale=15, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $priceChangeYear;

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
     */
    public function setAge($age): void
    {
        $this->age = $age;
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
     */
    public function setAlgorithm($algorithm): void
    {
        $this->algorithm = $algorithm;
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
     */
    public function setAvgVolumeWeeks52($avgVolumeWeeks52): void
    {
        $this->avgVolumeWeeks52 = $avgVolumeWeeks52;
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
     */
    public function setCirculatingSupply($circulatingSupply): void
    {
        $this->circulatingSupply = $circulatingSupply;
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
     */
    public function setDiscord($discord): void
    {
        $this->discord = $discord;
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
     */
    public function setFacebook($facebook): void
    {
        $this->facebook = $facebook;
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
     */
    public function setIcoAmount($icoAmount): void
    {
        $this->icoAmount = $icoAmount;
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
     */
    public function setInitialPrice($initialPrice): void
    {
        $this->initialPrice = $initialPrice;
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
     */
    public function setLastPrice($lastPrice): void
    {
        $this->lastPrice = $lastPrice;
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
     */
    public function setMarketCap($marketCap): void
    {
        $this->marketCap = $marketCap;
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
     */
    public function setMaxSupply($maxSupply): void
    {
        $this->maxSupply = $maxSupply;
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
     */
    public function setMedium($medium): void
    {
        $this->medium = $medium;
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
     */
    public function setMediumFollowers($mediumFollowers): void
    {
        $this->mediumFollowers = $mediumFollowers;
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
     */
    public function setPrice($price): void
    {
        $this->price = $price;
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
     */
    public function setPriceChangeDay($priceChangeDay): void
    {
        $this->priceChangeDay = $priceChangeDay;
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
     */
    public function setPriceChangeHour($priceChangeHour): void
    {
        $this->priceChangeHour = $priceChangeHour;
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
     */
    public function setPriceChangeMonth($priceChangeMonth): void
    {
        $this->priceChangeMonth = $priceChangeMonth;
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
     */
    public function setPriceChangePercent($priceChangePercent): void
    {
        $this->priceChangePercent = $priceChangePercent;
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
     */
    public function setPriceChangeSixMonth($priceChangeSixMonth): void
    {
        $this->priceChangeSixMonth = $priceChangeSixMonth;
    }

    /**
     * @return float|null
     */
    public function getPriceChangeWeek(): ?float
    {
        return $this->priceChangeWeek;
    }

    /**
     * @param float|null $priceChangeWeek
     */
    public function setPriceChangeWeek($priceChangeWeek): void
    {
        $this->priceChangeWeek = $priceChangeWeek;
    }

    /**
     * @return float|null
     */
    public function getPriceChangeYear(): ?float
    {
        return $this->priceChangeYear;
    }

    /**
     * @param float|null $priceChangeYear
     */
    public function setPriceChangeYear($priceChangeYear): void
    {
        $this->priceChangeYear = $priceChangeYear;
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
     */
    public function setReddit($reddit): void
    {
        $this->reddit = $reddit;
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
     */
    public function setRedditSubscriber($redditSubscriber): void
    {
        $this->redditSubscriber = $redditSubscriber;
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
     */
    public function setReturnOnIco($returnOnIco): void
    {
        $this->returnOnIco = $returnOnIco;
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
     */
    public function setSector($sector): void
    {
        $this->sector = $sector;
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
     */
    public function setAsset($asset): void
    {
        $this->asset = $asset;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getChange(): float
    {
        return $this->change;
    }

    /**
     * @param float $change
     */
    public function setChange(float $change): void
    {
        $this->change = $change;
    }

    /**
     * @return float
     */
    public function getWeeklyChange(): float
    {
        return $this->weeklyChange;
    }

    /**
     * @param float $weeklyChange
     */
    public function setWeeklyChange(float $weeklyChange): void
    {
        $this->weeklyChange = $weeklyChange;
    }

    /**
     * @return float
     */
    public function getYearToDayChange(): float
    {
        return $this->yearToDayChange;
    }

    /**
     * @param float $yearToDayChange
     */
    public function setYearToDayChange(float $yearToDayChange): void
    {
        $this->yearToDayChange = $yearToDayChange;
    }
}