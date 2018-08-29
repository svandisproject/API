<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kami\ApiCoreBundle\Annotation as Api;

/**
 * IcoValues
 *
 * @ORM\Table(name="ico_values")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\IcoValuesRepository")
 * @Api\AnonymousAccess()
 * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 */
class IcoValues
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     * @ORM\Column(name="white_list", type="boolean")
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     */
    private $whiteList = false;

    /**
     * @var bool
     * @ORM\Column(name="staking", type="boolean")
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     */
    private $staking = false;

    /**
     * @var bool
     * @ORM\Column(name="masternodes", type="boolean")
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     */
    private $masternodes = false;

    /**
     * @var bool
     * @ORM\Column(name="dividend", type="boolean")
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     */
    private $dividend = false;

    /**
     * @var bool
     * @ORM\Column(name="burning", type="boolean")
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     */
    private $burning = false;

    /**
     * @var bool
     * @ORM\Column(name="vesting", type="boolean")
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     */
    private $vesting = false;

    /**
     * @var bool
     * @ORM\Column(name="vcs", type="boolean")
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     */
    private $vcs = false;

    /**
     * @var bool
     * @ORM\Column(name="accredited_investors", type="boolean")
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     */
    private $accreditedInvestors = false;

    /**
     * @var bool
     * @ORM\Column(name="demoAvailability", type="boolean")
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     */
    private $demoAvailability = false;

    /**
     * @var bool
     * @ORM\Column(name="smartContractAudit", type="boolean")
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     */
    private $smartContractAudit = false;

    /**
     * @ORM\OneToOne(targetEntity="Ico", mappedBy="values")
     * @Api\Relation()
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     */
    private $ico;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\IcoBundle\Entity\MoodSignal", inversedBy="icoValues"
     * @Api\Relation()
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     */
    private $moodSignal;

    /**
     * @var int
     * @ORM\Column(name="project_completion", type="integer")
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     */
    private $projectCompletion;

    /**
     * @ORM\Column(name="listing_order", type="integer", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     */
    private $listingOrder;

    /**
     * @ORM\Column(name="kyc", type="decimal", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     */
    private $kyc;

    /**
     * @ORM\Column(name="open_presale", type="boolean")
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     */
    private $openPresale = false;

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
     * Set whiteList.
     *
     * @param bool $whiteList
     *
     * @return IcoValues
     */
    public function setWhiteList($whiteList)
    {
        $this->whiteList = $whiteList;

        return $this;
    }

    /**
     * Get whiteList.
     *
     * @return bool
     */
    public function getWhiteList()
    {
        return $this->whiteList;
    }

    /**
     * Set staking.
     *
     * @param bool $staking
     *
     * @return IcoValues
     */
    public function setStaking($staking)
    {
        $this->staking = $staking;

        return $this;
    }

    /**
     * Get staking.
     *
     * @return bool
     */
    public function getStaking()
    {
        return $this->staking;
    }

    /**
     * Set masternodes.
     *
     * @param bool $masternodes
     *
     * @return IcoValues
     */
    public function setMasternodes($masternodes)
    {
        $this->masternodes = $masternodes;

        return $this;
    }

    /**
     * Get masternodes.
     *
     * @return bool
     */
    public function getMasternodes()
    {
        return $this->masternodes;
    }

    /**
     * Set dividend.
     *
     * @param bool $dividend
     *
     * @return IcoValues
     */
    public function setDividend($dividend)
    {
        $this->dividend = $dividend;

        return $this;
    }

    /**
     * Get dividend.
     *
     * @return bool
     */
    public function getDividend()
    {
        return $this->dividend;
    }

    /**
     * Set burning.
     *
     * @param bool $burning
     *
     * @return IcoValues
     */
    public function setBurning($burning)
    {
        $this->burning = $burning;

        return $this;
    }

    /**
     * Get burning.
     *
     * @return bool
     */
    public function getBurning()
    {
        return $this->burning;
    }

    /**
     * Set demoAvailability.
     *
     * @param bool $demoAvailability
     *
     * @return IcoValues
     */
    public function setDemoAvailability($demoAvailability)
    {
        $this->demoAvailability = $demoAvailability;

        return $this;
    }

    /**
     * Get demoAvailability.
     *
     * @return bool
     */
    public function getDemoAvailability()
    {
        return $this->demoAvailability;
    }

    /**
     * Set smartContractAudit.
     *
     * @param bool $smartContractAudit
     *
     * @return IcoValues
     */
    public function setSmartContractAudit($smartContractAudit)
    {
        $this->smartContractAudit = $smartContractAudit;

        return $this;
    }

    /**
     * Get smartContractAudit.
     *
     * @return bool
     */
    public function getSmartContractAudit()
    {
        return $this->smartContractAudit;
    }

    /**
     * @return int
     */
    public function getProjectCompletion()
    {
        return $this->projectCompletion;
    }

    /**
     * @param mixed $projectCompletion
     *
     * @return self
     */
    public function setProjectCompletion($projectCompletion)
    {
        $this->projectCompletion = $projectCompletion;

        return $this;
    }

    /**
     * @param Ico $ico
     */
    public function setIco($ico)
    {
        $this->ico = $ico;
    }

    /**
     * @return integer
     */
    public function getListingOrder()
    {
        return $this->listingOrder;
    }

    /**
     * @param integer $listingOrder
     * @return self
     */
    public function setListingOrder($listingOrder)
    {
        $this->listingOrder = $listingOrder;
        return $this;
    }

    /**
     * @return Ico
     */
    public function getIco()
    {
        return $this->ico;
    }

    /**
     * @param MoodSignal $moodSignal
     * @return self
     */
    public function setMoodSignal($moodSignal)
    {
        $this->moodSignal = $moodSignal;
        return $this;
    }

    /**
     * @return MoodSignal
     */
    public function getMoodSignal()
    {
        return $this->moodSignal;
    }

    /**
     * @return float
     */
    public function getKyc()
    {
        return $this->kyc;
    }

    /**
     * @param float $kyc
     * @return self
     */
    public function setKyc($kyc)
    {
        $this->kyc = $kyc;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getOpenPresale()
    {
        return $this->openPresale;
    }

    /**
     * @param boolean $openPresale
     * @return self
     */
    public function setOpenPresale($openPresale)
    {
        $this->openPresale = $openPresale;
        return $this;
    }

    /**
     * @param bool $vesting
     * @return self
     */
    public function setVesting(bool $vesting)
    {
        $this->vesting = $vesting;
        return $this;
    }

    /**
     * @return bool
     */
    public function getVesting(): bool
    {
        return $this->vesting;
    }

    /**
     * @param bool $vcs
     * @return self
     */
    public function setVcs(bool $vcs)
    {
        $this->vcs = $vcs;
        return $this;
    }

    /**
     * @return bool
     */
    public function getVcs(): bool
    {
        return $this->vcs;
    }

    /**
     * @param bool $accreditedInvestors
     * @return self
     */
    public function setAccreditedInvestors(bool $accreditedInvestors)
    {
        $this->accreditedInvestors = $accreditedInvestors;
        return $this;
    }

    /**
     * @return bool
     */
    public function getAccreditedInvestors(): bool
    {
        return $this->accreditedInvestors;
    }

}
