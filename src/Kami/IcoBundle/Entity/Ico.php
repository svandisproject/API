<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Kami\AssetBundle\Entity\Asset;
use Kami\ContentBundle\Entity\Post;
use Kami\ApiCoreBundle\Annotation as Api;
use JMS\Serializer\Annotation\MaxDepth;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Ico
 *
 * @Gedmo\Loggable
 * @ORM\Table(name="ico")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\IcoRepository")
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
     * @ORM\Column(name="remote_id", type="integer", nullable=true)
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
     * @Gedmo\Versioned
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $description;

    /**
     * @ORM\Column(name="slogan", type="text", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $slogan;

    /**
     * @ORM\Column(name="problem", type="text", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $problem;

    /**
     * @ORM\OneToOne(targetEntity="Kami\AssetBundle\Entity\Asset", mappedBy="ico")
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\Relation()
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @MaxDepth(1)
     * @Gedmo\Versioned
     */
    private $asset;

    /**
     * @ORM\Column(name="country", type="string", length=3, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
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
     * @Gedmo\Versioned
     */
    private $forSale;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Person", inversedBy="icos", cascade={"persist"})
     * @ORM\JoinTable(name="ico_team")
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\Relation()
     * @MaxDepth(2)
     * @Gedmo\Versioned
     */
    private $team;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $staffSize;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Ico")
     * @ORM\JoinTable(name="ico_partners")
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\Relation()
     * @MaxDepth(1)
     * @Gedmo\Versioned
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
     * @MaxDepth(1)
     * @Gedmo\Versioned
     */
    private $competitors;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Industry", inversedBy="icos")
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\Relation()
     * @MaxDepth(1)
     * @Gedmo\Versioned
     */
    private $industries;

    /**
     * @ORM\Column(type="array", name="restricted_countries", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $restrictedCountries;

    /**
     * @ORM\OneToOne( targetEntity="Kami\IcoBundle\Entity\Dates", inversedBy="ico", cascade={"persist"})
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @MaxDepth(1)
     * @Gedmo\Versioned
     */
    private $dates;

    /**
     * @ORM\OneToOne(targetEntity="Kami\IcoBundle\Entity\Finance", inversedBy="ico", cascade={"persist"})
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @MaxDepth(2)
     * @Gedmo\Versioned
     */
    private $finance;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\IcoBundle\Entity\SaleStage", inversedBy="icos", cascade={"persist"})
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @MaxDepth(1)
     * @Gedmo\Versioned
     */
    private $saleStage;

    /**
     * @ORM\OneToOne(targetEntity="IcoValues", inversedBy="ico")
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $values;

    /**
     * @ORM\OneToOne(targetEntity="Kami\IcoBundle\Entity\SocialMedia", inversedBy="ico")
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $social_media;

    /**
     * @ORM\OneToOne(targetEntity="Kami\IcoBundle\Entity\Development", inversedBy="ico")
     * @Api\Relation()
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $development;

    /**
     * @ORM\Column(type="array", name="links", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $links;

    /**
     * @ORM\OneToOne(targetEntity="Kami\IcoBundle\Entity\Legal", inversedBy="ico")
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $legal;

    /**
     * @ORM\OneToMany(targetEntity="Kami\ContentBundle\Entity\Post", mappedBy="ico", cascade={"persist"})
     *
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @MaxDepth(1)
     * @Gedmo\Versioned
     */
    private $icoNews;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->team = new ArrayCollection();
        $this->partners = new ArrayCollection();
        $this->competitors = new ArrayCollection();
        $this->industries = new ArrayCollection();
        $this->icoNews = new ArrayCollection();
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
     * @return int|null
     */
    public function getStaffSize()
    {
        return $this->staffSize;
    }

    /**
     * @param int $staffSize
     * @return self
     */
    public function setStaffSize($staffSize)
    {
        $this->staffSize = $staffSize;
        return $this;
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
     * @return string
     */
    public function getSlogan()
    {
        return $this->slogan;
    }

    /**
     * @param string $slogan
     */
    public function setSlogan($slogan)
    {
        $this->slogan = $slogan;
    }

    /**
     * @return IcoValues
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param IcoValues $values
     *
     * @return self
     */
    public function setValues($values): self
    {
        $this->values = $values;
        $values->setIco($this);
        return $this;
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
     * @param int $forSale
     * @return $this
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
     * @param Ico $competitor
     * @return bool
     */
    public function removeCompetitor(Ico $competitor)
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
     * @param Industry $industry
     * @return $this
     */
    public function addIndustry(Industry $industry)
    {
        $this->industries[] = $industry;

        return $this;
    }

    /**
     * @param Industry $industry
     * @return bool
     */
    public function removeIndustry(Industry $industry)
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
     * @return Dates|null
     */
    public function getDates(): ?Dates
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
     * @return Finance|null
     */
    public function getFinance(): ?Finance
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
     * @return SaleStage|null
     */
    public function getSaleStage(): ?SaleStage
    {
        return $this->saleStage;
    }

    /**
     * @param SaleStage $saleStage
     *
     * @return self
     */
    public function setSaleStage($saleStage): self
    {
        $this->saleStage = $saleStage;
        return $this;
    }

    /**
     * @return SocialMedia
     */
    public function getSocialMedia()
    {
        return $this->social_media;
    }

    /**
     * @param $social_media
     * @return $this
     */
    public function setSocialMedia($social_media)
    {
        $this->social_media = $social_media;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getProblem()
    {
        return $this->problem;
    }

    /**
     * @param string $problem
     * @return self
     */
    public function setProblem($problem)
    {
        $this->problem = $problem;
        return $this;
    }

    /**
     * @return Development
     */
    public function getDevelopment()
    {
        return $this->development;
    }

    /**
     * @param Development $development
     * @return self
     */
    public function setDevelopment($development)
    {
        $this->development = $development;
        return $this;
    }

    /**
     * @return array
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Set links
     *
     * @param array $links
     * @return Ico
     */
    public function setLinks($links)
    {
        $this->links = $links;
        return $this;
    }

    /**
     * @return Legal
     */
    public function getLegal()
    {
        return $this->legal;
    }

    /**
     * @param Legal $legal
     * @return self
     */
    public function setLegal($legal)
    {
        $this->legal = $legal;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getIcoNews()
    {
        return $this->icoNews;
    }

    /**
     * @param $icoNews
     * @return $this
     */
    public function setIcoNews($icoNews)
    {
        $this->icoNews = $icoNews;
        return $this;
    }
}
