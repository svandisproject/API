<?php

namespace Kami\AssetBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Kami\ApiCoreBundle\Annotation as Api;

/**
 * Pair
 *
 * @ORM\Table(name="pair")
 * @ORM\Entity(repositoryClass="Kami\AssetBundle\Repository\PairRepository")
 * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
 * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
 */
class Pair
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
     * @ORM\Column(name="pair", type="string", length=100)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $pair;

    /**
     * @var string
     *
     * @ORM\Column(name="exchange", type="string", length=100)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $exchange;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\AssetBundle\Entity\Asset", inversedBy="pairs")
     * @ORM\JoinTable(name="assets_pairs", )
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Api\Relation()
     */
    private $assets;

    public function __construct()
    {
        $this->assets = new ArrayCollection();
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
     * Set pair.
     *
     * @param string $pair
     *
     * @return Pair
     */
    public function setPair($pair)
    {
        $this->pair = $pair;

        return $this;
    }

    /**
     * Get pair.
     *
     * @return string
     */
    public function getPair()
    {
        return $this->pair;
    }

    /**
     * Set exchange.
     *
     * @param string $exchange
     *
     * @return Pair
     */
    public function setExchange($exchange)
    {
        $this->exchange = $exchange;

        return $this;
    }

    /**
     * Get exchange.
     *
     * @return string
     */
    public function getExchange()
    {
        return $this->exchange;
    }

    /**
     * @return ArrayCollection
     */
    public function getAssets(): ArrayCollection
    {
        return $this->assets;
    }

    /**
     * @param Asset $asset
     * @return self
     */
    public function setAsset(Asset $asset): self
    {
        if ($this->assets->contains($asset)) {
            $this->assets[] = $asset;
            $asset->setPair($this);
        }
        return $this;
    }

    /**
     * @param Asset $asset
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAsset (Asset $asset)
    {
            $this->assets->removeElement($asset);
    }

}
