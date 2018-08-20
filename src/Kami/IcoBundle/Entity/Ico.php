<?php

namespace Kami\IcoBundle\Entity;

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
     * @ORM\Column(name="remote_id", type="integer", unique=true, nullable=true)
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
     * @ORM\OneToOne(targetEntity="Kami\AssetBundle\Entity\Asset", mappedBy="ico")
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
     * @ORM\OneToOne( targetEntity="Kami\IcoBundle\Entity\Dates", mappedBy="ico", cascade={"persist"})
     */
    private $dates;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $website_link;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $problem_to_solve;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $white_list;

    /**
     * @ORM\OneToOne(targetEntity="Kami\IcoBundle\Entity\Finance", mappedBy="ico", cascade={"persist"})
     */
    private $finance;

    /**
     * @ORM\OneToOne(targetEntity="Kami\IcoBundle\Entity\Development", mappedBy="ico", cascade={"persist"})
     */
    private $development;

    /**
     * @ORM\OneToOne(targetEntity="Kami\IcoBundle\Entity\Legal", mappedBy="ico", cascade={"persist"})
     */
    private $legal;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\IcoBundle\Entity\SaleStage", inversedBy="icos", cascade={"persist"})
     */
    private $sale_stage;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->team = new ArrayCollection();
        $this->advisors = new ArrayCollection();
        $this->partners = new ArrayCollection();
        $this->competitors = new ArrayCollection();
        $this->industries = new ArrayCollection();
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
     * @param Asset|null $asset
     *
     * @return Ico
     */
    public function setAsset($asset = null)
    {
        if ($asset) {
            $this->asset = $asset;
            $asset->setIco($this);
        }

        return $this;
    }

    /**
     * Get asset.
     *
     * @return Asset|null
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
     * @param Person $team
     *
     * @return Ico
     */
    public function addTeam(Person $team)
    {
        $this->team[] = $team;

        return $this;
    }

    /**
     * Remove team.
     *
     * @param Person $team
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTeam(Person $team)
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
     * @param Person $advisor
     *
     * @return Ico
     */
    public function addAdvisor(Person $advisor)
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
    public function removeAdvisor(Person $advisor)
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
     * @param Ico $partner
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePartner(Ico $partner)
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
     * @param Ico $competitor
     *
     * @return Ico
     */
    public function addCompetitor(Ico $competitor)
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

    /**
     * @return Dates
     */
    public function getDates()
    {
        return $this->dates;
    }

    /**
     * @param Dates $dates
     *
     * @return self
     */
    public function setDates(Dates $dates): self
    {
        $this->dates = $dates;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWebsiteLink(): ?string
    {
        return $this->website_link;
    }

    /**
     * @param string $website_link
     *
     * @return self
     */
    public function setWebsiteLink($website_link): self
    {
        $this->website_link = $website_link;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProblemToSolve(): ?string
    {
        return $this->problem_to_solve;
    }

    /**
     * @param string $problem_to_solve
     *
     * @return self
     */
    public function setProblemToSolve($problem_to_solve): self
    {
        $this->problem_to_solve = $problem_to_solve;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWhiteList(): ?string
    {
        return $this->white_list;
    }

    /**
     * @param string $white_list
     *
     * @return self
     */
    public function setWhiteList($white_list): self
    {
        $this->white_list = $white_list;
        return $this;
    }

    /**
     * @return Finance
     */
    public function getFinance(): Finance
    {
        return $this->finance;
    }

    /**
     * @param Finance $finance
     *
     * @return self
     */
    public function setFinance($finance): self
    {
        $this->finance = $finance;
        return $this;
    }

    /**
     * @return Development
     */
    public function getDevelopment(): Development
    {
        return $this->development;
    }

    /**
     * @param Development $development
     *
     * @return self
     */
    public function setDevelopment($development): self
    {
        $this->development = $development;
        return $this;
    }

    /**
     * @return Legal
     */
    public function getLegal(): Legal
    {
        return $this->legal;
    }

    /**
     * @param Legal $legal
     *
     * @return self
     */
    public function setLegal($legal): self
    {
        $this->legal = $legal;

        return $this;
    }

    /**
     * @return SaleStage
     */
    public function getSaleStage(): SaleStage
    {
        return $this->sale_stage;
    }

    /**
     * @param SaleStage $sale_stage
     *
     * @return self
     */
    public function setSaleStage($sale_stage): self
    {
        $this->sale_stage = $sale_stage;
        return $this;
    }
}
