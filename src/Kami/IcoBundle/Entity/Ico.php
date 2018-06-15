<?php

namespace Kami\IcoBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Kami\AssetBundle\Entity\Asset;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Kami\ApiCoreBundle\Annotation as Api;

/**
 * Ico
 *
 * @ORM\Table(name="ico")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\IcoRepository")
 * @UniqueEntity({"remoteId"})
 * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
 * @Api\AnonymousAccess()
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
 */
class Ico
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
     * @ORM\Column(name="remote_id", type="integer", unique=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $remoteId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $title;

    /**
     * @ORM\OneToOne(targetEntity="Kami\AssetBundle\Entity\Asset")
     * @ORM\Column(name="asset", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $asset;

    /**
     * @ORM\Column(name="country", type="string", length=3, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $country;

    /**
     * @ORM\Column(name="open_presale", type="datetime", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $openPresale;

    /**
     * @ORM\Column(name="kyc", type="boolean", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $kyc;

    /**
     * @var string|null
     *
     * @ORM\Column(name="hard_cap", type="string", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $hardCap;

    /**
     * @var int|null
     *
     * @ORM\Column(name="total_cap", type="integer", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $totalCap;

    /**
     * @var int|null
     *
     * @ORM\Column(name="raised", type="decimal", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $raised;

    /**
     * @var string|null
     *
     * @ORM\Column(name="token_price", type="string", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $tokenPrice;

    /**
     * @var int|null
     *
     * @ORM\Column(name="for_sale", type="smallint", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $forSale;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="token_sale_date", type="datetime", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $tokenSaleDate;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Person", cascade={"persist"})
     * @ORM\JoinTable(name="ico_team")
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\Relation()
     */
    private $team;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Person", cascade={"persist"})
     * @ORM\JoinTable(name="ico_advisors")
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\Relation()
     */
    private $advisors;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Ico")
     * @ORM\JoinTable(name="ico_partners")
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\Relation()
     */
    private $partners;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Ico")
     * @ORM\JoinTable(name="ico_competitors")
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\Relation()
     */
    private $competitors;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Industry", inversedBy="icos")
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\Relation()
     */
    private $industries;


    /**
     * @ORM\Column(type="array", name="restricted_countries")
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $restrictedCountries;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->team = new \Doctrine\Common\Collections\ArrayCollection();
        $this->advisors = new \Doctrine\Common\Collections\ArrayCollection();
        $this->partners = new \Doctrine\Common\Collections\ArrayCollection();
        $this->competitors = new \Doctrine\Common\Collections\ArrayCollection();
        $this->industries = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set remoteId.
     *
     * @param int $remoteId
     *
     * @return Ico
     */
    public function setRemoteId($remoteId)
    {
        $this->remoteId = $remoteId;

        return $this;
    }

    /**
     * Get remoteId.
     *
     * @return int
     */
    public function getRemoteId()
    {
        return $this->remoteId;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Ico
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set asset.
     *
     * @param string|null $asset
     *
     * @return Ico
     */
    public function setAsset($asset = null)
    {
        $this->asset = $asset;

        return $this;
    }

    /**
     * Get asset.
     *
     * @return string|null
     */
    public function getAsset()
    {
        return $this->asset;
    }

    /**
     * Set country.
     *
     * @param string $country
     *
     * @return Ico
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set openPresale.
     *
     * @param \DateTime|null $openPresale
     *
     * @return Ico
     */
    public function setOpenPresale($openPresale = null)
    {
        $this->openPresale = $openPresale;

        return $this;
    }

    /**
     * Get openPresale.
     *
     * @return \DateTime|null
     */
    public function getOpenPresale()
    {
        return $this->openPresale;
    }

    /**
     * Set kyc.
     *
     * @param bool|null $kyc
     *
     * @return Ico
     */
    public function setKyc($kyc = null)
    {
        $this->kyc = $kyc;

        return $this;
    }

    /**
     * Get kyc.
     *
     * @return bool|null
     */
    public function getKyc()
    {
        return $this->kyc;
    }

    /**
     * Set hardCap.
     *
     * @param string|null $hardCap
     *
     * @return Ico
     */
    public function setHardCap($hardCap = null)
    {
        $this->hardCap = $hardCap;

        return $this;
    }

    /**
     * Get hardCap.
     *
     * @return string|null
     */
    public function getHardCap()
    {
        return $this->hardCap;
    }

    /**
     * Set totalCap.
     *
     * @param int|null $totalCap
     *
     * @return Ico
     */
    public function setTotalCap($totalCap = null)
    {
        $this->totalCap = $totalCap;

        return $this;
    }

    /**
     * Get totalCap.
     *
     * @return int|null
     */
    public function getTotalCap()
    {
        return $this->totalCap;
    }

    /**
     * Set raised.
     *
     * @param string|null $raised
     *
     * @return Ico
     */
    public function setRaised($raised = null)
    {
        $this->raised = $raised;

        return $this;
    }

    /**
     * Get raised.
     *
     * @return string|null
     */
    public function getRaised()
    {
        return $this->raised;
    }

    /**
     * Set tokenPrice.
     *
     * @param string|null $tokenPrice
     *
     * @return Ico
     */
    public function setTokenPrice($tokenPrice = null)
    {
        $this->tokenPrice = $tokenPrice;

        return $this;
    }

    /**
     * Get tokenPrice.
     *
     * @return string|null
     */
    public function getTokenPrice()
    {
        return $this->tokenPrice;
    }

    /**
     * Set forSale.
     *
     * @param int|null $forSale
     *
     * @return Ico
     */
    public function setForSale($forSale = null)
    {
        $this->forSale = $forSale;

        return $this;
    }

    /**
     * Get forSale.
     *
     * @return int|null
     */
    public function getForSale()
    {
        return $this->forSale;
    }

    /**
     * Set tokenSaleDate.
     *
     * @param \DateTime|null $tokenSaleDate
     *
     * @return Ico
     */
    public function setTokenSaleDate($tokenSaleDate = null)
    {
        $this->tokenSaleDate = $tokenSaleDate;

        return $this;
    }

    /**
     * Get tokenSaleDate.
     *
     * @return \DateTime|null
     */
    public function getTokenSaleDate()
    {
        return $this->tokenSaleDate;
    }

    /**
     * Set restrictedCountries.
     *
     * @param array $restrictedCountries
     *
     * @return Ico
     */
    public function setRestrictedCountries($restrictedCountries)
    {
        $this->restrictedCountries = $restrictedCountries;

        return $this;
    }

    /**
     * Get restrictedCountries.
     *
     * @return array
     */
    public function getRestrictedCountries()
    {
        return $this->restrictedCountries;
    }

    /**
     * Add team.
     *
     * @param \Kami\IcoBundle\Entity\Person $team
     *
     * @return Ico
     */
    public function addTeam(\Kami\IcoBundle\Entity\Person $team)
    {
        $this->team[] = $team;

        return $this;
    }

    /**
     * Remove team.
     *
     * @param \Kami\IcoBundle\Entity\Person $team
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTeam(\Kami\IcoBundle\Entity\Person $team)
    {
        return $this->team->removeElement($team);
    }

    /**
     * Get team.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Add advisor.
     *
     * @param \Kami\IcoBundle\Entity\Person $advisor
     *
     * @return Ico
     */
    public function addAdvisor(\Kami\IcoBundle\Entity\Person $advisor)
    {
        $this->advisors[] = $advisor;

        return $this;
    }

    /**
     * Remove advisor.
     *
     * @param \Kami\IcoBundle\Entity\Person $advisor
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAdvisor(\Kami\IcoBundle\Entity\Person $advisor)
    {
        return $this->advisors->removeElement($advisor);
    }

    /**
     * Get advisors.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdvisors()
    {
        return $this->advisors;
    }

    /**
     * Add partner.
     *
     * @param \Kami\IcoBundle\Entity\Ico $partner
     *
     * @return Ico
     */
    public function addPartner(\Kami\IcoBundle\Entity\Ico $partner)
    {
        $this->partners[] = $partner;

        return $this;
    }

    /**
     * Remove partner.
     *
     * @param \Kami\IcoBundle\Entity\Ico $partner
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePartner(\Kami\IcoBundle\Entity\Ico $partner)
    {
        return $this->partners->removeElement($partner);
    }

    /**
     * Get partners.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPartners()
    {
        return $this->partners;
    }

    /**
     * Add competitor.
     *
     * @param \Kami\IcoBundle\Entity\Ico $competitor
     *
     * @return Ico
     */
    public function addCompetitor(\Kami\IcoBundle\Entity\Ico $competitor)
    {
        $this->competitors[] = $competitor;

        return $this;
    }

    /**
     * Remove competitor.
     *
     * @param \Kami\IcoBundle\Entity\Ico $competitor
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCompetitor(\Kami\IcoBundle\Entity\Ico $competitor)
    {
        return $this->competitors->removeElement($competitor);
    }

    /**
     * Get competitors.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompetitors()
    {
        return $this->competitors;
    }

    /**
     * Add industry.
     *
     * @param \Kami\IcoBundle\Entity\Industry $industry
     *
     * @return Ico
     */
    public function addIndustry(\Kami\IcoBundle\Entity\Industry $industry)
    {
        $this->industries[] = $industry;

        return $this;
    }

    /**
     * Remove industry.
     *
     * @param \Kami\IcoBundle\Entity\Industry $industry
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeIndustry(\Kami\IcoBundle\Entity\Industry $industry)
    {
        return $this->industries->removeElement($industry);
    }

    /**
     * Get industries.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIndustries()
    {
        return $this->industries;
    }

    /**
     * @param mixed $team
     * @return Ico
     */
    public function setTeam($team)
    {
        $this->team = $team;
        return $this;
    }

    /**
     * @param mixed $advisors
     * @return Ico
     */
    public function setAdvisors($advisors)
    {
        $this->advisors = $advisors;
        return $this;
    }

    /**
     * @param mixed $partners
     * @return Ico
     */
    public function setPartners($partners)
    {
        $this->partners = $partners;
        return $this;
    }

    /**
     * @param mixed $competitors
     * @return Ico
     */
    public function setCompetitors($competitors)
    {
        $this->competitors = $competitors;
        return $this;
    }

    /**
     * @param mixed $industries
     * @return Ico
     */
    public function setIndustries($industries)
    {
        $this->industries = $industries;
        return $this;
    }

}
