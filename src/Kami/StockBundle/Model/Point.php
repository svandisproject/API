<?php


namespace Kami\StockBundle\Model;


use Kami\AssetBundle\Entity\Asset;

class Point
{
    /**
     * @var \DateTime
     */
    private $time;

    /**
     * @var Asset
     */
    private $asset;

    /**
     * @var integer
     */
    private $price;

    public function __construct(Asset $asset, \DateTime $time, $price)
    {
        $this->time = $time;
        $this->asset = $asset;
        $this->price = $price;
    }

    /**
     * @return \DateTime
     */
    public function getTime(): \DateTime
    {
        return $this->time;
    }

    /**
     * @return Asset
     */
    public function getAsset(): Asset
    {
        return $this->asset;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

}