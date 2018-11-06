<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use const false;
use Kami\ApiCoreBundle\Annotation as Api;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * IcoValues
 *
 * @ORM\Table(name="ico_values")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\IcoValuesRepository")
 * @Api\AnonymousAccess()
 * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
 * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
 * @Gedmo\Loggable
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
     * @ORM\Column(name="white_list", type="boolean", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $whiteList = false;

    /**
     * @var bool
     * @ORM\Column(name="staking", type="boolean", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $staking = false;

    /**
     * @var bool
     * @ORM\Column(name="masternodes", type="boolean", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $masternodes = false;

    /**
     * @var bool
     * @ORM\Column(name="dividend", type="boolean", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $dividend = false;

    /**
     * @var bool
     * @ORM\Column(name="burning", type="boolean", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $burning = false;

    /**
     * @var bool
     * @ORM\Column(name="vesting", type="boolean", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $vesting = false;

    /**
     * @var bool
     * @ORM\Column(name="vcs", type="boolean", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $vcs = false;

    /**
     * @var bool
     * @ORM\Column(name="accredited_investors", type="boolean", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $accreditedInvestors = false;

    /**
     * @var bool
     * @ORM\Column(name="demoAvailability", type="boolean", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $demoAvailability = false;

    /**
     * @var bool
     * @ORM\Column(name="smartContractAudit", type="boolean", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $smartContractAudit = false;

    /**
     * @ORM\OneToOne(targetEntity="Ico", mappedBy="values")
     * @Api\Relation()
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $ico;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\IcoBundle\Entity\MoodSignal", inversedBy="icoValues")
     * @Api\Relation()
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $moodSignal;

    /**
     * @var int
     * @ORM\Column(name="project_completion", type="integer", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $projectCompletion;

    /**
     * @ORM\Column(name="listing_order", type="integer", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $listingOrder;

    /**
     * @ORM\Column(name="kyc", type="decimal", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $kyc;

    /**
     * @ORM\Column(name="open_presale", type="boolean", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
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
     * @param bool $whiteList|null
     *
     * @return IcoValues
     */
    public function setWhiteList($whiteList = false)
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
     * @param bool $staking|null
     *
     * @return IcoValues
     */
    public function setStaking($staking = false)
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
     * @param bool $masternodes|null
     *
     * @return IcoValues
     */
    public function setMasternodes($masternodes = false)
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
     * @param bool $dividend|null
     *
     * @return IcoValues
     */
    public function setDividend($dividend = false)
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
     * @param bool $burning|null
     *
     * @return IcoValues
     */
    public function setBurning($burning = false)
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
     * @param bool $demoAvailability|null
     *
     * @return IcoValues
     */
    public function setDemoAvailability($demoAvailability = false)
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
     * @param bool $smartContractAudit|null
     *
     * @return IcoValues
     */
    public function setSmartContractAudit($smartContractAudit = false)
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
     * @param integer $listingOrder | null
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
     * @param float $kyc | null
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
     * @param boolean $openPresale | null
     * @return self
     */
    public function setOpenPresale($openPresale = false)
    {
        $this->openPresale = $openPresale;
        return $this;
    }

    /**
     * @param bool $vesting | null
     * @return self
     */
    public function setVesting(?bool $vesting = false )
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
     * @param bool $vcs | null
     * @return self
     */
    public function setVcs(?bool $vcs = false)
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
     * @param bool $accreditedInvestors | null
     * @return self
     */
    public function setAccreditedInvestors(?bool $accreditedInvestors = false)
    {
        $this->accreditedInvestors = $accreditedInvestors;
        return $this;
    }

    /**
     * @return boolean|null
     */
    public function getAccreditedInvestors(): ?bool
    {
        return $this->accreditedInvestors;
    }

}
