<?php


namespace Kami\AssetBundle\Model;

use Kami\IcoBundle\Entity\Industry;
use Kami\ApiCoreBundle\Annotation as Api;

/**
 * Class TradableToken
 * @package Kami\AssetBundle\Model
 * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
 */
class TradableToken
{
    /**
     * @var string
     *
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     */
    private $ticker;

    /**
     * @var string
     *
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     */
    private $title;

    /**
     * @var Industry
     *
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     */
    private $industry;

    /**
     * @var integer
     *
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     */
    private $marketCap;


    /**
     * @var float
     *
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     */
    private $price;

    /**
     * @var string|null
     *
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     */
    private $change;

    /**
     * @var string|null
     *
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     */
    private $weeklyChange;

    /**
     * @var string|null
     *
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     */
    private $yearToDayChange;

    /**
     * @var float
     *
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     */
    private $volume;

    /**
     * @return string
     */
    public function getTicker(): string
    {
        return $this->ticker;
    }

    /**
     * @param string $ticker
     * @return TradableToken
     */
    public function setTicker(string $ticker): TradableToken
    {
        $this->ticker = $ticker;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return TradableToken
     */
    public function setTitle(string $title): TradableToken
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Industry
     */
    public function getIndustry(): Industry
    {
        return $this->industry;
    }

    /**
     * @param Industry $industry
     * @return TradableToken
     */
    public function setIndustry(Industry $industry): TradableToken
    {
        $this->industry = $industry;

        return $this;
    }

    /**
     * @return int
     */
    public function getMarketCap(): int
    {
        return $this->marketCap;
    }

    /**
     * @param int $marketCap
     * @return TradableToken
     */
    public function setMarketCap(int $marketCap): TradableToken
    {
        $this->marketCap = $marketCap;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return TradableToken
     */
    public function setPrice(float $price): TradableToken
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getChange()
    {
        return $this->change;
    }

    /**
     * @param string|null $change
     * @return TradableToken
     */
    public function setChange($change): TradableToken
    {
        $this->change = $change;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getWeeklyChange()
    {
        return $this->weeklyChange;
    }

    /**
     * @param string|null $weeklyChange
     * @return TradableToken
     */
    public function setWeeklyChange($weeklyChange): TradableToken
    {
        $this->weeklyChange = $weeklyChange;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getYearToDayChange()
    {
        return $this->yearToDayChange;
    }

    /**
     * @param string|null $yearToDayChange
     * @return TradableToken
     */
    public function setYearToDayChange($yearToDayChange): TradableToken
    {
        $this->yearToDayChange = $yearToDayChange;

        return $this;
    }

    /**
     * @return int
     */
    public function getVolume(): int
    {
        return $this->volume;
    }

    /**
     * @param int $volume
     * @return TradableToken
     */
    public function setVolume(int $volume): TradableToken
    {
        $this->volume = $volume;

        return $this;
    }
}