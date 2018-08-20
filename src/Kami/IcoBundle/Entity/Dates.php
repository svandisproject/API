<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dates
 *
 * @ORM\Table(name="dates")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\DatesRepository")
 */
class Dates
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
     * @var \DateTime|null
     *
     * @ORM\Column(name="private_sale_start", type="datetime", nullable=true)
     */
    private $privateSaleStart;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="private_sale_end", type="datetime", nullable=true)
     */
    private $privateSaleEnd;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="presale_start", type="datetime", nullable=true)
     */
    private $presaleStart;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="presale_end", type="datetime", nullable=true)
     */
    private $presaleEnd;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="public_sale_start", type="datetime", nullable=true)
     */
    private $publicSaleStart;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="public_sale_end", type="datetime", nullable=true)
     */
    private $publicSaleEnd;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="testnet_date", type="datetime", nullable=true)
     */
    private $testnetDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="mainnet_date", type="datetime", nullable=true)
     */
    private $mainnetDate;

    /**
     * @ORM\OneToOne(targetEntity="Kami\IcoBundle\Entity\ICO", inversedBy="dates")
     */
    private $ico;


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
     * Set privateSaleStart.
     *
     * @param \DateTime|null $privateSaleStart
     *
     * @return Dates
     */
    public function setPrivateSaleStart($privateSaleStart = null)
    {
        $this->privateSaleStart = $privateSaleStart;

        return $this;
    }

    /**
     * Get privateSaleStart.
     *
     * @return \DateTime|null
     */
    public function getPrivateSaleStart()
    {
        return $this->privateSaleStart;
    }

    /**
     * Set privateSaleEnd.
     *
     * @param \DateTime|null $privateSaleEnd
     *
     * @return Dates
     */
    public function setPrivateSaleEnd($privateSaleEnd = null)
    {
        $this->privateSaleEnd = $privateSaleEnd;

        return $this;
    }

    /**
     * Get privateSaleEnd.
     *
     * @return \DateTime|null
     */
    public function getPrivateSaleEnd()
    {
        return $this->privateSaleEnd;
    }

    /**
     * Set presaleStart.
     *
     * @param \DateTime|null $presaleStart
     *
     * @return Dates
     */
    public function setPresaleStart($presaleStart = null)
    {
        $this->presaleStart = $presaleStart;

        return $this;
    }

    /**
     * Get presaleStart.
     *
     * @return \DateTime|null
     */
    public function getPresaleStart()
    {
        return $this->presaleStart;
    }

    /**
     * Set presaleEnd.
     *
     * @param \DateTime|null $presaleEnd
     *
     * @return Dates
     */
    public function setPresaleEnd($presaleEnd = null)
    {
        $this->presaleEnd = $presaleEnd;

        return $this;
    }

    /**
     * Get presaleEnd.
     *
     * @return \DateTime|null
     */
    public function getPresaleEnd()
    {
        return $this->presaleEnd;
    }

    /**
     * Set publicSaleStart.
     *
     * @param \DateTime|null $publicSaleStart
     *
     * @return Dates
     */
    public function setPublicSaleStart($publicSaleStart = null)
    {
        $this->publicSaleStart = $publicSaleStart;

        return $this;
    }

    /**
     * Get publicSaleStart.
     *
     * @return \DateTime|null
     */
    public function getPublicSaleStart()
    {
        return $this->publicSaleStart;
    }

    /**
     * Set publicSaleEnd.
     *
     * @param \DateTime|null $publicSaleEnd
     *
     * @return Dates
     */
    public function setPublicSaleEnd($publicSaleEnd = null)
    {
        $this->publicSaleEnd = $publicSaleEnd;

        return $this;
    }

    /**
     * Get publicSaleEnd.
     *
     * @return \DateTime|null
     */
    public function getPublicSaleEnd()
    {
        return $this->publicSaleEnd;
    }

    /**
     * Set testnetDate.
     *
     * @param \DateTime|null $testnetDate
     *
     * @return Dates
     */
    public function setTestnetDate($testnetDate = null)
    {
        $this->testnetDate = $testnetDate;

        return $this;
    }

    /**
     * Get testnetDate.
     *
     * @return \DateTime|null
     */
    public function getTestnetDate()
    {
        return $this->testnetDate;
    }

    /**
     * Set mainnetDate.
     *
     * @param \DateTime|null $mainnetDate
     *
     * @return Dates
     */
    public function setMainnetDate($mainnetDate = null)
    {
        $this->mainnetDate = $mainnetDate;

        return $this;
    }

    /**
     * Get mainnetDate.
     *
     * @return \DateTime|null
     */
    public function getMainnetDate()
    {
        return $this->mainnetDate;
    }

    /**
     * Set ico.
     *
     * @param string $ico
     *
     * @return Dates
     */
    public function setIco($ico)
    {
        $this->ico = $ico;

        return $this;
    }

    /**
     * Get ico.
     *
     * @return string
     */
    public function getIco()
    {
        return $this->ico;
    }
}
