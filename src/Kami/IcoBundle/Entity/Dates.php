<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kami\ApiCoreBundle\Annotation as Api;

/**
 * Dates
 *
 * @ORM\Table(name="dates")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\DatesRepository")
 * @Api\AnonymousAccess()
 * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
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
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $privateSaleStart;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="private_sale_end", type="datetime", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $privateSaleEnd;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="presale_start", type="datetime", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $presaleStart;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="presale_end", type="datetime", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $presaleEnd;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="crowdsale_start", type="datetime", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $crowdsaleStart;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="crowdsale_end", type="datetime", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     *
     */
    private $crowdsaleEnd;

    /**
     * @var int
     *
     * @ORM\Column(name="days_left", type="integer")
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $daysLeft;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $lockup;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $vesting;

    /**
     * @ORM\OneToOne(targetEntity="Kami\IcoBundle\Entity\ICO", mappedBy="dates")
     * @Api\AnonymousAccess()
     * @Api\Relation()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
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
     * @return \DateTime|null
     */
    public function getCrowdsaleEnd()
    {
        return $this->crowdsaleEnd;
    }

    /**
     * @param \DateTime $crowdsaleEnd
     *
     * @return self
     */
    public function setCrowdsaleEnd($crowdsaleEnd): self
    {
        $this->crowdsaleEnd = $crowdsaleEnd;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCrowdsaleStart()
    {
        return $this->crowdsaleStart;
    }

    /**
     * @param \DateTime $crowdsaleStart
     *
     * @return self
     */
    public function setCrowdsaleStart($crowdsaleStart): self
    {
        $this->crowdsaleStart = $crowdsaleStart;

        return $this;
    }

    /**
     * @return integer
     */
    public function getDaysLeft()
    {
        return $this->daysLeft;
    }

    /**
     * @param integer $daysLeft
     *
     * @return self
     */
    public function setDaysLeft($daysLeft): self
    {
        $this->daysLeft = $daysLeft;

        return $this;
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

    /**
     * @return \DateTime | null
     */
    public function getLockup()
    {
        return $this->lockup;
    }

    /**
     * @param \DateTime $lockup
     * @return self
     */
    public function setLockup($lockup)
    {
        $this->lockup = $lockup;
        return $this;
    }

    /**
     * @return \DateTime | null
     */
    public function getVesting()
    {
        return $this->vesting;
    }

    /**
     * @param mixed $vesting
     * @return self
     */
    public function setVesting($vesting)
    {
        $this->vesting = $vesting;
        return $this;
    }
}
