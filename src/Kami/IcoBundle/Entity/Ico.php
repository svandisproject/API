<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Kami\AssetBundle\Entity\Asset;


/**
 * @ORM\Entity
 * @ORM\Table(name="`ico`")
 */
class Ico
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="Kami\IcoBundle\Entity\TokenType")
     * @ORM\JoinColumn(name="token_type_id", referencedColumnName="id")
     */
    private $tokenType;

    /**
     * @ORM\Column(type="array")
     */
    private $restrictedCountries;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\AssetBundle\Entity\Asset", mappedBy="icos")
     */
    private $assets;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Person")
     * @ORM\JoinTable(name="ico_blockhain_advisors",
     *      joinColumns={@ORM\JoinColumn(name="ico_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="person_id", referencedColumnName="id")}
     *      )
     */
    private $blockhainAdvisors;

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
     * @ORM\ManyToOne(targetEntity="Kami\IcoBundle\Entity\Product", inversedBy="ico")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\IcoBundle\Entity\Industry", inversedBy="ico")
     * @ORM\JoinColumn(name="industry_id", referencedColumnName="id")
     */
    private $industry;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Ico", mappedBy="competitorsIco")
     */
    private $competitorForIco;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Ico", inversedBy="competitorForIco")
     * @ORM\JoinTable(name="competitors",
     *      joinColumns={@ORM\JoinColumn(name="ico_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="competitor_ico_id", referencedColumnName="id")}
     *      )
     */
    private $competitorsIco;

    /**
     * @ORM\Column(type="string")
     */
    private $country;

    public function __construct() {
        $this->countryRestrictions = new ArrayCollection();
        $this->assets = new ArrayCollection();
        $this->blockhainAdvisors = new ArrayCollection();
        $this->industryAdvisors = new ArrayCollection();
        $this->legalPartners = new ArrayCollection();
        $this->competitorForIco = new ArrayCollection();
        $this->competitorsIco = new ArrayCollection();
    }

    /**
     * Add asset.
     *
     * @param Asset $asset
     *
     * @return Ico
     */
    public function addAsset(Asset $asset)
    {
        $this->assets[] = $asset;

        return $this;
    }

    /**
     * Remove asset.
     *
     * @param Asset $asset
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAsset(Asset $asset)
    {
        return $this->assets->removeElement($asset);
    }

    /**
     * Get assets.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssets()
    {
        return $this->assets;
    }

    /**
     * Set product.
     *
     * @param Product $product
     *
     * @return Ico
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product.
     *
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set industry.
     *
     * @param Industry $industry
     *
     * @return Ico
     */
    public function setIndustry(industry $industry)
    {
        $this->industry = $industry;

        return $this;
    }

    /**
     * Get industry.
     *
     * @return Industry
     */
    public function getIndustry()
    {
        return $this->industry;
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
     * Set restrictedCountry.
     *
     * @param string $restrictedCountry
     */
    public function addRestrictionCountry($restrictedCountry)
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
     * Set tokenType.
     *
     * @param string $tokenType
     *
     * @return Ico
     */
    public function setTokenType($tokenType)
    {
        $this->tokenType = $tokenType;

        return $this;
    }

    /**
     * Get tokenType.
     *
     * @return TokenType
     */
    public function getTokenType()
    {
        return $this->tokenType;
    }

    /**
     * @ORM\Column(type="decimal", name="ico_token_price_usd")
     */
    protected $icoTokenPriceUsd;

    /**
     * @ORM\Column(type="decimal", name="ico_token_price_eth")
     */
    protected $icoTokenPriceEth;

    /**
     * @ORM\Column(type="decimal", name="hard_cap_usd")
     */
    protected $hardCapUsd;

    /**
     * @ORM\Column(type="decimal", name="hard_cap_eth")
     */
    protected $hardCapEth;

    /**
     * @ORM\Column(type="decimal", name="min_cap_usd")
     */
    protected $minCapUsd;

    /**
     * @ORM\Column(type="decimal", name="already_raised")
     */
    protected $alreadyRaised;

    /**
     * @ORM\Column(type="boolean", name="whitelist")
     */
    protected $whitelist;

    /**
     * @ORM\Column(type="boolean", name="kyc")
     */
    protected $kyc;

    /**
     * @ORM\Column(type="integer", name="bonus1")
     */
    protected $bonus1;

    /**
     * @ORM\Column(type="integer", name="bonus2")
     */
    protected $bonus2;

    /**
     * @ORM\Column(type="integer", name="bonus3")
     */
    protected $bonus3;

    /**
     * @ORM\Column(type="boolean", name="open_presale")
     */
    protected $openPresale;

    /**
     * @ORM\Column(type="integer", name="team_tokens")
     */
    protected $teamTokens;

    /**
     * @ORM\Column(type="boolean", name="smart_contract_audit")
     */
    protected $smartContractAudit;

    /**
     * @ORM\Column(type="integer", name="team")
     */
    protected $team;

    /**
     * Set team.
     *
     * @param $team
     *
     * @return Ico
     */
    public function setTeam($team)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team.
     */
    public function getTeam()
    {
        return $this->team;
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
        $this->openPresale = $openPresale;

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
     * Set bonus3.
     *
     * @param $bonus3
     *
     * @return Ico
     */
    public function setBonus3($bonus3)
    {
        $this->bonus3 = $bonus3;

        return $this;
    }

    /**
     * Get bonus3.
     */
    public function getBonus3()
    {
        return $this->bonus3;
    }

    /**
     * Set bonus2.
     *
     * @param $bonus2
     *
     * @return Ico
     */
    public function setBonus2($bonus2)
    {
        $this->bonus2 = $bonus2;

        return $this;
    }

    /**
     * Get bonus2.
     */
    public function getBonus2()
    {
        return $this->bonus2;
    }

    /**
     * Set bonus1.
     *
     * @param $bonus1
     *
     * @return Ico
     */
    public function setBonus1($bonus1)
    {
        $this->bonus1 = $bonus1;

        return $this;
    }

    /**
     * Get bonus1.
     */
    public function getBonus1()
    {
        return $this->bonus1;
    }

    /**
     * Set kyc.
     *
     * @param $kyc
     *
     * @return Ico
     */
    public function setKyc($kyc)
    {
        $this->kyc = $kyc;

        return $this;
    }

    /**
     * Get kyc.
     *
     * @return boolean
     */
    public function getKyc()
    {
        return $this->kyc;
    }

    /**
     * Set whitelist.
     *
     * @param $whitelist
     *
     * @return Ico
     */
    public function setWhitelist($whitelist)
    {
        $this->whitelist = $whitelist;

        return $this;
    }

    /**
     * Get whitelist.
     *
     * @return boolean
     */
    public function getWhitelist()
    {
        return $this->whitelist;
    }

    /**
     * Set alreadyRaised.
     *
     * @param $alreadyRaised
     *
     * @return Ico
     */
    public function setAlreadyRaised($alreadyRaised)
    {
        $this->alreadyRaised = $alreadyRaised;

        return $this;
    }

    /**
     * Get alreadyRaised.
     */
    public function getAlreadyRaised()
    {
        return $this->alreadyRaised;
    }

    /**
     * Set minCapUsd.
     *
     * @param $minCapUsd
     *
     * @return Ico
     */
    public function setMinCapUsd($minCapUsd)
    {
        $this->minCapUsd = $minCapUsd;

        return $this;
    }

    /**
     * Get minCapUsd.
     */
    public function getMinCapUsd()
    {
        return $this->minCapUsd;
    }

    /**
     * Set hardCapEth.
     *
     * @param $hardCapEth
     *
     * @return Ico
     */
    public function setHardCapEth($hardCapEth)
    {
        $this->hardCapEth = $hardCapEth;

        return $this;
    }

    /**
     * Get hardCapEth.
     */
    public function getHardCapEth()
    {
        return $this->hardCapEth;
    }

    /**
     * Set hardCapUsd.
     *
     * @param $hardCapUsd
     *
     * @return Ico
     */
    public function setHardCapUsd($hardCapUsd)
    {
        $this->hardCapUsd = $hardCapUsd;

        return $this;
    }

    /**
     * Get hardCapUsd.
     */
    public function getHardCapUsd()
    {
        return $this->hardCapUsd;
    }

    /**
     * Set icoTokenPriceEth.
     *
     * @param $icoTokenPriceEth
     *
     * @return Ico
     */
    public function setIcoTokenPriceEth($icoTokenPriceEth)
    {
        $this->icoTokenPriceEth = $icoTokenPriceEth;

        return $this;
    }

    /**
     * Get icoTokenPriceEth.
     */
    public function getIcoTokenPriceEth()
    {
        return $this->icoTokenPriceEth;
    }

    /**
     * Set icoTokenPriceUsd.
     *
     * @param $icoTokenPriceUsd
     *
     * @return Ico
     */
    public function setIcoTokenPriceUsd($icoTokenPriceUsd)
    {
        $this->icoTokenPriceUsd = $icoTokenPriceUsd;

        return $this;
    }

    /**
     * Get icoTokenPriceUsd.
     */
    public function getIcoTokenPriceUsd()
    {
        return $this->icoTokenPriceUsd;
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


}
