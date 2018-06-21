<?php


namespace Kami\StockBundle\Model;


use Kami\AssetBundle\Entity\Asset;

class Point implements StorableInterface
{
    /**
     * @var \DateTime
     */
    private $updateTime;

    /**
     * @var Asset
     */
    private $asset;

    /**
     * @var integer
     */
    private $price;

    public function __construct(Asset $asset, \DateTime $updateTime, $price)
    {
        $this->time = $updateTime;
        $this->asset = $asset;
        $this->price = $price;
    }

    /**
     * @return \DateTime
     */
    public function getUpdateTime(): \DateTime
    {
        return $this->updateTime;
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

    public function toDatabaseValues(): array
    {
        return [
            'time'  => $this->updateTime->format(\DateTime::W3C),
            'asset' => $this->asset->getTicker(),
            'price' => $this->price
        ];
    }
}