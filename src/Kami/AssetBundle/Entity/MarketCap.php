<?php


namespace Kami\AssetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kami\ApiCoreBundle\Annotation as Api;


/**
 * MarketCap
 *
 * @ORM\Table(name="coin_market_cap")
 * @ORM\Entity(repositoryClass="Kami\AssetBundle\Repository\MarketCapRepository")
 * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
 * @Api\AnonymousAccess()
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
 */
class MarketCap
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
     * @ORM\Column(name="circulating_supply", type="float")
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $circulatingSupply;

    /**
     * @ORM\Column(name="market_cap", type="float", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $marketCap;

    /**
     * @ORM\Column(name="volume24", type="float", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $volume24;

    /**
     * @ORM\OneToOne(targetEntity="Kami\AssetBundle\Entity\Asset", mappedBy="marketCap")
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $asset;

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
    public function getMarketCap()
    {
        return $this->marketCap;
    }

    /**
     * @param float $marketCap
     */
    public function setMarketCap($marketCap): void
    {
        $this->marketCap = $marketCap;
    }

    /**
     * @param Asset $asset
     *
     * @return self
     */
    public function setAsset($asset)
    {
        $this->asset = $asset;
        $asset->setMarketCap($this);

        return $this;
    }

    /**
     * @return Asset
     */
    public function getAsset()
    {
        return $this->asset;
    }

    /**
     * @param integer $circulatingSupply
     */
    public function setCirculatingSupply($circulatingSupply)
    {
        $this->circulatingSupply = $circulatingSupply;
    }

    /**
     * @return integer
     */
    public function getCirculatingSupply()
    {
        return $this->circulatingSupply;
    }

    /**
     * @param integer $volume24
     */
    public function setVolume24($volume24)
    {
        $this->volume24 = $volume24;
    }

    /**
     * @return integer
     */
    public function getVolume24()
    {
        return $this->volume24;
    }

}