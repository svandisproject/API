<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Kami\AssetBundle\Entity\Asset;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\IcoRepository")
 * @ORM\Table(name="`ico`")
 * @UniqueEntity({"remoteId"})
 */
class Ico
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="rating", type="decimal")
     */
    private $rating;

    /**
     * @ORM\Column(name="rating_team", type="decimal", nullable=true)
     */
    private $ratingTeam;

    /**
     * @ORM\Column(name="rating_profile", type="decimal", nullable=true)
     */
    private $ratingProfile;
    /**
     * @ORM\Column(name="rating_vision", type="decimal", nullable=true)
     */
    private $ratingVision;

    /**
     * @ORM\Column(name="rating_product", type="decimal", nullable=true)
     */
    private $ratingProduct;

    /**
     *@ORM\Column(type="integer", unique=true)
     */
    private $remoteId;

    /**
     * @ORM\Column(name="ico_url", type="string", length=255, nullable=true)
     */
    private $icoUrl;

    /**
     * @ORM\Column(name="ico_tagline", type="string", length=255, nullable=true)
     */
    private $icoTagline;

    /**
     * @ORM\Column(name="ico_intro", type="text", nullable=true)
     */
    private $icoIntro;

    /**
     * @ORM\Column(name="ico_about", type="text", nullable=true)
     */
    private $icoAbout;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\IcoBundle\Entity\TokenType", inversedBy="icos")
     * @ORM\JoinColumn(name="token_type_id", referencedColumnName="id")
     */
    private $tokenType;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $restrictedCountries;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\AssetBundle\Entity\Asset")
     * @ORM\JoinTable(name="ico_asset",
     *     joinColumns={@ORM\JoinColumn(name="ico_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="asset_id", referencedColumnName="id")})
     */
    private $acceptingAssets;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Person")
     * @ORM\JoinTable(name="ico_blockchain_advisors",
     *      joinColumns={@ORM\JoinColumn(name="ico_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="person_id", referencedColumnName="id")}
     *      )
     */
    private $blockchainAdvisors;

    /**
     *@ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Person")
     *@ORM\JoinTable(name="ico_industry_advisors",
     *      joinColumns={@ORM\JoinColumn(name="ico_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="person_id", referencedColumnName="id")}
     *      )
     */
    private $industryAdvisors;

    /**
     *@ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Person")
     *@ORM\JoinTable(name="ico_legal_partners",
     *      joinColumns={@ORM\JoinColumn(name="ico_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="person_id", referencedColumnName="id")}
     *      )
     */
    private $legalPartners;

    /**
     * @ORM\Column(name="ico_token", type="string", length=100)
     */
    private $icoToken;

    /**
     * @ORM\Column(name="ico_platform", type="string", length=100)
     */
    private $platform;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Industry", inversedBy="icos")
     * @ORM\JoinTable(name="icos_industies")
     */
    private $industries;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Ico", mappedBy="competitorsIcos")
     */
    private $competitorForIcos;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Ico", inversedBy="competitorForIcos")
     * @ORM\JoinTable(name="competitors",
     *      joinColumns={@ORM\JoinColumn(name="ico_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="competitor_ico_id", referencedColumnName="id")}
     *      )
     */
    private $competitorsIcos;

    /**
     * @ORM\Column(type="string", name="ico_token_price", nullable=true)
     */
    protected $icoTokenPrice;

    /**
     * @ORM\Column(type="string", name="hard_cap", nullable=true)
     */
    private $hardCap;

    /**
     * @ORM\Column(type="string", name="min_cap", nullable=true)
     */
    private $minCap;

    /**
     * @ORM\Column(type="string", name="raised")
     */
    private $raised;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Kyc")
     * @ORM\JoinTable(name="kyc_icos",
     *      joinColumns={@ORM\JoinColumn(name="ico_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="kyc_id", referencedColumnName="id")}
     *      )
     */
    private $kyc;

    /**
     * @ORM\Column(type="boolean", name="bonus", nullable=true)
     */
    private $bonus;

    /**
     * @ORM\Column(type="datetime", name="open_presale", nullable=true)
     */
    private $openPresale;

    /**
     * @ORM\Column(type="integer", name="team_tokens", nullable=true)
     */
    private $teamTokens;

    /**
     * @ORM\Column(type="boolean", name="smart_contract_audit", nullable=true)
     */
    private $smartContractAudit;

    /**
     *@ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Person")
     *@ORM\JoinTable(name="ico_member",
     *      joinColumns={@ORM\JoinColumn(name="ico_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="member_id", referencedColumnName="id")}
     *      )
     */
    private $teamMembers;

    /**
     * @ORM\Column(type="string")
     */
    private $country;

    public function __construct() {
        $this->acceptingAssets = new ArrayCollection();
        $this->blockchainAdvisors = new ArrayCollection();
        $this->industryAdvisors = new ArrayCollection();
        $this->legalPartners = new ArrayCollection();
        $this->competitorForIcos = new ArrayCollection();
        $this->competitorsIcos = new ArrayCollection();
        $this->industries = new ArrayCollection();
        $this->teamMembers = new ArrayCollection();
        $this->kyc = new ArrayCollection();
    }

    /**
     * Add blockchainAdvisor.
     * @param Person $blockchainAdvisor
     *
     * @return Ico
     */
    public function addBlockhainAdvisor(Person $blockchainAdvisor)
    {
        $this->blockchainAdvisors[] = $blockchainAdvisor;
        return $this;
    }

    /**
     * Remove blockchainAdvisor
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeBlockchainAdvisor(Person $blockchainAdvisor)
    {
       return $this->blockchainAdvisors->removeElement($blockchainAdvisor);
    }

    /**
     *
     *  @return \Doctrine\Common\Collections\Collection
     */
    public function getBlockchainAdvisors()
    {
        return $this->blockchainAdvisors;
    }

    /**
     * Add industryAdvisor.
     * @param Person $industryAdvisor
     *
     * @return Ico
     */
    public function addIndustryAdvisor(Person $industryAdvisor)
    {
        $this->industryAdvisors[] = $industryAdvisor;
        return $this;
    }

    /**
     * Remove industryAdvisor
     *
     * @param Person $industryAdvisor
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeIndustryAdvisor(Person $industryAdvisor)
    {
        return $this->industryAdvisors->removeElement($industryAdvisor);
    }

    /**
     *
     *  @return \Doctrine\Common\Collections\Collection
     */
    public function getIndustryAdvisor()
    {
        return $this->industryAdvisors;
    }

    /**
     * Add legalPartner.
     * @param Person $legalPartner
     *
     * @return Ico
     */
    public function addLegalPartner(Person $legalPartner)
    {
        $this->legalPartners[] = $legalPartner;
        return $this;
    }

    /**
     * Remove legalPartner
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeLegalPartner(Person $legalPartner)
    {
        return $this->legalPartners->removeElement($legalPartner);
    }

    /**
     * Get legalPartners
     *
     *  @return \Doctrine\Common\Collections\Collection
     */
    public function getLegalPartners()
    {
        return $this->legalPartners;
    }

    /**
     * Add teamMember.
     * @param Person $teamMember
     *
     * @return Ico
     */
    public function addTeamMember(Person $teamMember)
    {
        if($this->teamMembers->contains($teamMember)){
                return;
        }
        $this->teamMembers[] = $teamMember;
        return $this;
    }

    /**
     * Remove teamMember
     *
     * @param Person $teamMember
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTeamMember(Person $teamMember)
    {
        return $this->teamMembers->removeElement($teamMember);
    }

    /**
     * Add kyc.
     * @param Kyc $kyc
     *
     * @return Ico
     */
    public function addKyc(Kyc $kyc)
    {
        if($this->kyc->contains($kyc)){
            return;
        }
        $this->kyc[] = $kyc;
        return $this;
    }

    /**
     * Remove kyc
     *
     * @param Kyc $kyc
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeKyc(Kyc $kyc)
    {
        return $this->kyc->removeElement($kyc);
    }

    /**
     * Get kyc
     *
     *  @return \Doctrine\Common\Collections\Collection
     */
    public function getKyc()
    {
        return $this->kyc;
    }

    /**
     * Add acceptingAsset.
     *
     * @param Asset $asset
     *
     * @return Ico
     */
    public function addAcceptingAsset(Asset $asset)
    {
        $asset->addIco($this);
        $this->acceptingAssets[] = $asset;
        return $this;
    }

    /**
     * Remove acceptingAsset.
     *
     * @param Asset $asset
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAsset(Asset $asset)
    {
        return $this->acceptingAssets->removeElement($asset);
    }

    /**
     * Get acceptingAssets.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAcceptingAssets()
    {
        return $this->acceptingAssets;
    }

    /**
     * Set icoToken.
     *
     * @param string $token
     *
     * @return Ico
     */
    public function setIcoToken($token)
    {
        $this->icoToken = $token;

        return $this;
    }

    /**
     * Get icoToken.
     *
     * @return string
     */
    public function getIcoToken()
    {
        return $this->icoToken;
    }

    /**
     * @param string $icoAbout
     *
     * @return Ico
     */
    public function setIcoAbout($icoAbout)
    {
        $this->icoAbout = $icoAbout;
        return $this;
    }

    /**
     * @return string
     */
    public function getIcoAbout()
    {
        return $this->icoAbout;
    }

    /**
     * @param string $icoIntro
     *
     * @return Ico
     */
    public function setIcoIntro($icoIntro)
    {
        $this->icoIntro = $icoIntro;
        return $this;
    }

    /**
     * @return string
     */
    public function getIcoIntro()
    {
        return $this->icoIntro;
    }

    /**
     * @param string $icoTagline
     *
     * @return Ico
     */
    public function setIcoTagline($icoTagline)
    {
        $this->icoTagline = $icoTagline;

        return $this;
    }

    /**
     * @return string
     */
    public function getIcoTagline()
    {
        return $this->icoTagline;
    }

    /**
     * @param string $icoUrl
     *
     * @return Ico
     */
    public function setIcoUrl($icoUrl)
    {
        $this->icoUrl = $icoUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getIcoUrl()
    {
        return $this->icoUrl;
    }

    /**
     * Set platform.
     *
     * @param string $platform
     *
     * @return Ico
     */
    public function setPlatform($platform)
    {
        $this->platform = $platform;

        return $this;
    }

    /**
     * Get platform.
     *
     * @return string
     */
    public function getPlatform()
    {
        return $this->platform;
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
     * Add industries.
     *
     * @param Industry $industry
     *
     * @return Ico
     */
    public function addIndustry(Industry $industry)
    {
        if($this->industries->contains($industry)){
            return;
        }
        $this->industries[] = $industry;

        return $this;
    }

    /**
     * Get industries.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIndustry()
    {
        return $this->industries;
    }

    /**
     * Remove industry
     *
     * @param Industry $industry
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeIco($industry)
    {
        $industry->removeIco($this);
        return $this->industries->removeElement($industry);

    }

     /**
     * Set country.
     * @param string $country
     * @return Ico
      *
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
     * Add restrictedCountry.
     *
     * @param string $restrictedCountry
     */
    public function addRestrictedCountry($restrictedCountry)
    {
        $this->restrictedCountries[] = $restrictedCountry;
    }

    /**
     * Get restrictedCountries.
     *
     * @return array
     */
    public function getRestrictedCountry()
    {
        return $this->restrictedCountries;
    }

    /**
     * Set smartContractAudit.
     *
     * @param $smartContractAudit
     *
     * @return Ico
     */
    public function setSmartContractAudit($smartContractAudit)
    {
        $this->smartContractAudit = $smartContractAudit;

        return $this;
    }

    /**
     * Get smartContractAudit.
     *
     * @return boolean
     */
    public function getSmartContractAudit()
    {
        return $this->smartContractAudit;
    }

    /**
     * Set teamTokens.
     *
     * @param $teamTokens
     *
     * @return Ico
     */
    public function setTeamTokens($teamTokens)
    {
        $this->teamTokens = $teamTokens;

        return $this;
    }

    /**
     * Get teamTokens.
     */
    public function getTeamTokens()
    {
        return $this->teamTokens;
    }

    /**
     * Set openPresale.
     *
     * @param $openPresale
     *
     * @return Ico
     */
    public function setOpenPresale($openPresale)
    {
        if (!$openPresale instanceof \DateTime) {
            $this->$openPresale = ($openPresale != '0000-00-00 00:00:00') ?
                \DateTime::createFromFormat('Y-m-d H:i:s', $openPresale) :
                null;
            return $this;
        }
        $this->$openPresale = $openPresale;

        return $this;
    }

    /**
     * Get openPresale.
     *
     * @return boolean
     */
    public function getOpenPresale()
    {
        return $this->openPresale;
    }


    /**
     * Set bonus.
     *
     * @param $bonus
     *
     * @return Ico
     */
    public function setBonus($bonus)
    {
        $this->bonus = $bonus;

        return $this;
    }

    /*
     * Get bonus.
     */
    public function getBonus()
    {
        return $this->bonus;
    }


    /**
     * Set raised.
     *
     * @param $raised
     *
     * @return Ico
     */
    public function setRaised($raised)
    {
        $this->raised = $raised;

        return $this;
    }

    /**
     * Get raised.
     */
    public function getRaised()
    {
        return $this->raised;
    }

    /**
     * Set minCap.
     *
     * @param $minCap
     *
     * @return Ico
     */
    public function setMinCap($minCap)
    {
        $this->minCap = $minCap;

        return $this;
    }

    /**
     * Get minCap.
     */
    public function getMinCap()
    {
        return $this->minCap;
    }

    /**
     * Set tokenType.
     *
     * @param TokenType $tokenType
     *
     * @return Ico
     */
    public function setTokenType(TokenType $tokenType)
    {
        $tokenType->addIco($this);
        $this->tokenType = $tokenType;

        return $this;
    }

    /**
     * Get tokenType.
     */
    public function getTokenType()
    {
        return $this->tokenType;
    }

    /**
     * Set hardCap.
     *
     * @param $hardCap
     *
     * @return Ico
     */
    public function setHardCap($hardCap)
    {
        $this->hardCap = $hardCap;

        return $this;
    }

    /**
     * Get hardCap.
     */
    public function getHardCap()
    {
        return $this->hardCap;
    }

    /**
     * Set icoTokenPrice.
     *
     * @param $icoTokenPrice
     *
     * @return Ico
     */
    public function setIcoTokenPrice($icoTokenPrice)
    {
        $this->icoTokenPrice = $icoTokenPrice;

        return $this;
    }

    /**
     * Get icoTokenPrice.
     */
    public function getIcoTokenPrice()
    {
        return $this->icoTokenPrice;
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
     * Get rating
     *
     * @return integer
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * Get ratingProduct
     *
     * @return integer
     */
    public function getRatingProduct()
    {
        return $this->ratingProduct;
    }

    /**
     * Set ratingProduct
     *
     * @param integer $ratingProduct
     */
    public function setRatingProduct($ratingProduct)
    {
        $this->ratingProduct = $ratingProduct;
    }

    /**
     * Get ratingProfile
     *
     * @return integer $ratingProfile
     */
    public function getRatingProfile()
    {
        return $this->ratingProfile;
    }

    /**
     * Set ratingProfile
     *
     * @param integer $ratingProfile
     */
    public function setRatingProfile($ratingProfile)
    {
        $this->ratingProfile = $ratingProfile;
    }

    /**
     * Get ratingTeam
     *
     * @return integer $ratingTeam
     */
    public function getRatingTeam()
    {
        return $this->ratingTeam;
    }

    /**
     * Set ratingTeam
     *
     * @param integer $ratingTeam
     */
    public function setRatingTeam($ratingTeam)
    {
        $this->ratingTeam = $ratingTeam;
    }

    /**
     * Get ratingVision
     *
     * @return integer $ratingVision
     */
    public function getRatingVision()
    {
        return $this->ratingVision;
    }

    /**
     * Set ratingVision
     *
     * @param integer $ratingVision
     */
    public function setRatingVision($ratingVision)
    {
        $this->ratingVision = $ratingVision;
    }


}
