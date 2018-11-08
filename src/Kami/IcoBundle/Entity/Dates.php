<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kami\ApiCoreBundle\Annotation as Api;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Dates
 *
 * @ORM\Table(name="dates")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\DatesRepository")
 * @Api\AnonymousAccess()
 * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
 * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
 * @Gedmo\Loggable
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
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Api\Form(type="Symfony\Component\Form\Extension\Core\Type\DateTimeType",
     *     options={"widget": "single_text"})
     * @Gedmo\Versioned
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
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Api\Form(type="Symfony\Component\Form\Extension\Core\Type\DateTimeType",
     *     options={"widget": "single_text"})
     * @Gedmo\Versioned
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
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Api\Form(type="Symfony\Component\Form\Extension\Core\Type\DateTimeType",
     *     options={"widget": "single_text"})
     * @Gedmo\Versioned
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
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Api\Form(type="Symfony\Component\Form\Extension\Core\Type\DateTimeType",
     *     options={"widget": "single_text"})
     * @Gedmo\Versioned
     */
    private $presaleEnd;

    /**
     *  @var \DateTime|null
     *
     * @ORM\Column(name="ico_start", type="datetime", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Api\Form(type="Symfony\Component\Form\Extension\Core\Type\DateTimeType",
     *     options={"widget": "single_text"})
     * @Gedmo\Versioned
     */
    private $icoStart;

    /**
     *  @var \DateTime|null
     *
     * @ORM\Column(name="ico_end", type="datetime", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Api\Form(type="Symfony\Component\Form\Extension\Core\Type\DateTimeType",
     *     options={"widget": "single_text"})
     * @Gedmo\Versioned
     */
    private $icoEnd;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="crowdsale_start", type="datetime", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Api\Form(type="Symfony\Component\Form\Extension\Core\Type\DateTimeType",
     *     options={"widget": "single_text"})
     * @Gedmo\Versioned
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
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Api\Form(type="Symfony\Component\Form\Extension\Core\Type\DateTimeType",
     *     options={"widget": "single_text"})
     * @Gedmo\Versioned
     *
     */
    private $crowdsaleEnd;

    /**
     * @var int
     *
     * @ORM\Column(name="days_left", type="integer", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $daysLeft;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Api\Form(type="Symfony\Component\Form\Extension\Core\Type\DateTimeType",
     *     options={"widget": "single_text"})
     * @Gedmo\Versioned
     */
    private $lockup;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Api\Form(type="Symfony\Component\Form\Extension\Core\Type\DateTimeType",
     *     options={"widget": "single_text"})
     * @Gedmo\Versioned
     */
    private $vesting;

    /**
     * @ORM\OneToOne(targetEntity="Kami\IcoBundle\Entity\Ico", mappedBy="dates")
     * @Api\AnonymousAccess()
     * @Api\Relation()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
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
     * @param Ico $ico
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

    /**
     * @return \DateTime|null
     */
    public function getIcoStart()
    {
        return $this->icoStart;
    }

    /**
     * @param \DateTime|null $icoStart
     * @return self
     */
    public function setIcoStart($icoStart)
    {
        $this->icoStart = $icoStart;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getIcoEnd()
    {
        return $this->icoEnd;
    }

    /**
     * @param \DateTime|null $icoEnd
     * @return self
     */
    public function setIcoEnd($icoEnd)
    {
        $this->icoEnd = $icoEnd;
        return $this;
    }
}
