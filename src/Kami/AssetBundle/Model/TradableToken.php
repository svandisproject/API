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
     * @var float
     *
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     */
    private $change;

    /**
     * @var float
     *
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     */
    private $weeklyChange;

    /**
     * @var float
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
     * @return float|null
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     * @return TradableToken
     */
    public function setPrice ($price): TradableToken
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return float
     */
    public function getChange():float
    {
        return $this->change;
    }

    /**
     * @param float $change
     * @return TradableToken
     */
    public function setChange($change): TradableToken
    {
        $this->change = $change;

        return $this;
    }

    /**
     * @return float
     */
    public function getWeeklyChange():float
    {
        return $this->weeklyChange;
    }

    /**
     * @param float $weeklyChange
     * @return TradableToken
     */
    public function setWeeklyChange($weeklyChange): TradableToken
    {
        $this->weeklyChange = $weeklyChange;

        return $this;
    }

    /**
     * @return float
     */
    public function getYearToDayChange():float
    {
        return $this->yearToDayChange;
    }

    /**
     * @param float $yearToDayChange
     * @return TradableToken
     */
    public function setYearToDayChange($yearToDayChange): TradableToken
    {
        $this->yearToDayChange = $yearToDayChange;

        return $this;
    }

    /**
     * @return double
     */
    public function getVolume(): double
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