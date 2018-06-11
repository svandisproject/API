<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ico
 *
 * @ORM\Table(name="ico")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\IcoRepository")
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @ORM\OneToOne(targetEntity="Kami\AssetBundle\Entity\Asset")
     */
    private $asset;

    /**
     * @ORM\Column(name="country", type="string", length=2, nullable=true)
     */
    private $country;

    /**
     * @ORM\Column(name="restricted_countries", type="array", nullable=true)
     */
    private $restrictedCountries;

    /**
     * @ORM\Column(name="open_presale", type="boolean", nullable=true)
     */
    private $openPresale;

    /**
     * @ORM\Column(name="kyc", type="boolean", nullable=true)
     */
    private $kyc;

    /**
     * @var int|null
     *
     * @ORM\Column(name="hard_cap", type="integer", nullable=true)
     */
    private $hardCap;

    /**
     * @var int|null
     *
     * @ORM\Column(name="total_cap", type="integer", nullable=true)
     */
    private $totalCap;

    /**
     * @var int|null
     *
     * @ORM\Column(name="raised", type="integer", nullable=true)
     */
    private $raised;

    /**
     * @var int|null
     *
     * @ORM\Column(name="tokenPrice", type="integer", nullable=true)
     */
    private $tokenPrice;

    /**
     * @var int|null
     *
     * @ORM\Column(name="forSale", type="smallint", nullable=true)
     */
    private $forSale;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="token_sale_date", type="date", nullable=true)
     */
    private $tokenSaleDate;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Person")
     * @ORM\JoinTable(name="ico_team")
     */
    private $team;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Person")
     * @ORM\JoinTable(name="ico_advisors")
     */
    private $advisors;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Ico")
     * @ORM\JoinTable(name="ico_partners")
     */
    private $partners;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Ico")
     * @ORM\JoinTable(name="ico_competitors")
     */
    private $competitors;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Industry", inversedBy="icos")
     */
    private $industries;

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
     * Set country.
     *
     * @param string|null $country
     *
     * @return Ico
     */
    public function setCountry($country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country.
     *
     * @return string|null
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set restrictedCountries.
     *
     * @param array|null $restrictedCountries
     *
     * @return Ico
     */
    public function setRestrictedCountries($restrictedCountries = null)
    {
        $this->restrictedCountries = $restrictedCountries;

        return $this;
    }

    /**
     * Get restrictedCountries.
     *
     * @return array|null
     */
    public function getRestrictedCountries()
    {
        return $this->restrictedCountries;
    }

    /**
     * Set openPresale.
     *
     * @param bool|null $openPresale
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
     * @return bool|null
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
     * @param int|null $hardCap
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
     * @return int|null
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
     * @param int|null $raised
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
     * @return int|null
     */
    public function getRaised()
    {
        return $this->raised;
    }

    /**
     * Set tokenPrice.
     *
     * @param int|null $tokenPrice
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
     * @return int|null
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
     * Set asset.
     *
     * @param \Kami\AssetBundle\Entity\Asset|null $asset
     *
     * @return Ico
     */
    public function setAsset(\Kami\AssetBundle\Entity\Asset $asset = null)
    {
        $this->asset = $asset;

        return $this;
    }

    /**
     * Get asset.
     *
     * @return \Kami\AssetBundle\Entity\Asset|null
     */
    public function getAsset()
    {
        return $this->asset;
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
}
