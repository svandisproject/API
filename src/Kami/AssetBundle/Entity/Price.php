<?php

namespace Kami\AssetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kami\ApiCoreBundle\Annotation as Api;

/**
 * Price
 *
 * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
 * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
 * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
 * @ORM\Entity
 * @ORM\Table(name="price")
 */
class Price
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
     * @ORM\OneToOne(targetEntity="Kami\AssetBundle\Entity\Asset", mappedBy="price")
     */
    private $asset;

    /**
     * @var int
     *
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * @var string
     *
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @ORM\Column(name="currency", type="string", length=100)
     */
    private $currency;


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
     * Set asset.
     *
     * @param $asset
     *
     * @return Price
     */
    public function setAsset($asset)
    {
        $this->asset = $asset;

        return $this;
    }

    /**
     * Get asset.
     *
     */
    public function getAsset()
    {
        return $this->asset;
    }

    /**
     * Set amount.
     *
     * @param int $amount
     *
     * @return Price
     */

    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount.
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set currency.
     *
     * @param string $currency
     *
     * @return Price
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency.
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }
}
