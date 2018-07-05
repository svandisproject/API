<?php


namespace Kami\AssetBundle\Model;

use Kami\IcoBundle\Entity\Industry;

class TradableToken
{
    /**
     * @var string
     */
    private $ticker;

    /**
     * @var string
     */
    private $title;

    /**
     * @var Industry
     */
    private $industry;

    /**
     * @var integer
     */
    private $marketCap;

    /**
     * @var float
     */
    private $price;

    /**
     * @var float
     */
    private $change;

    /**
     * @var float
     */
    private $weeklyChange;

    /**
     * @var float
     */
    private $yearToDayChange;

    /**
     * @var float
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
     * @return float
     */
    public function getChange(): float
    {
        return $this->change;
    }

    /**
     * @param float $change
     * @return TradableToken
     */
    public function setChange(float $change): TradableToken
    {
        $this->change = $change;

        return $this;
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
     * @return TradableToken
     */
    public function setWeeklyChange(float $weeklyChange): TradableToken
    {
        $this->weeklyChange = $weeklyChange;

        return $this;
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
     * @return TradableToken
     */
    public function setYearToDayChange(float $yearToDayChange): TradableToken
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