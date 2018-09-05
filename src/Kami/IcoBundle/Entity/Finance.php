<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Kami\ApiCoreBundle\Annotation as Api;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Finance
 *
 * @ORM\Table(name="finance")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\FinanceRepository")
 * @Api\AnonymousAccess()
 * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
 * @Gedmo\Loggable
 */
class Finance
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
     * @var float
     * @ORM\Column(name="token_price_eth", type="decimal", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $tokenPriceEth;

    /**
     * @ORM\Column(name="accepted_currencies", type="array", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $acceptedCurrencies;

    /**
     * @var int
     *
     * @ORM\Column(name="total_supply", type="bigint", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $totalSupply;

    /**
     * @var int
     *
     * @ORM\Column(name="sale_supply", type="bigint", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $saleSupply;

    /**
     * @ORM\Column(name="tokens_being_sold", type="integer", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $tokensBeingSold;

    /**
     * @ORM\Column(name="private_sold_tokens", type="integer", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $privateSoldTokens;

    /**
     * @ORM\Column(name="presale_sold_tokens", type="integer", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $presaleSoldTokens;

    /**
     * @ORM\Column(name="crowdsale_sold_tokens", type="integer", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $crowdsaleSoldTokens;

    /**
     * @ORM\Column(name="total_supply_valuation", type="integer", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $totalSupplyValuation;

    /**
     * @ORM\Column(name="tokens_to_team", type="integer", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $tokensToTeam;

    /**
     * @ORM\Column(name="individual_cap", type="float", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $individualCap;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $circulatingSupply;

    /**
     * @ORM\Column(name="team_vesting_cliff", type="integer", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $teamVestingClif;

    /**
     * @ORM\Column(name="advisors_vesting_clif", type="integer", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $advisorsVestingClif;

    /**
     * @ORM\Column(name="presale_contributors_vesting_clif", type="integer", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $presaleContributorsVestingClif;


    /**
     * @var float
     *
     * @ORM\Column(name="hard_cap", type="decimal", precision=25, scale=5, nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $hardCap;

    /**
     * @var float
     *
     * @ORM\Column(name="hard_cap_eth", type="decimal", precision=25, scale=5,  nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $hardCapEth;

    /**
     * @var float
     *
     * @ORM\Column(name="raised_usd", type="decimal", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $raisedUsd;

    /**
     * @var array
     *
     * @ORM\Column(name="distribution", type="array", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $distribution;

    /**
     * @var float|null
     * @ORM\Column(name="price_crypto", type="float", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $priceCrypto;

    /**
     * @var float|null
     *
     * @ORM\Column(name="min_cap", type="decimal", precision=25, scale=5, nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $minCap;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $debts;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $historyOfBankruptcy;

    /**
     * @ORM\OneToOne(targetEntity="Kami\IcoBundle\Entity\Ico", mappedBy="finance")
     * @Api\Relation()
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $ico;

    /**@Gedmo\Versioned
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $vestedTokens;

    /**
     * @ORM\Column(type="array", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $bonuses;

    /**
     * @ORM\Column(name="day_to_liquidity", type="integer", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $dayToLiquidity;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Person", inversedBy="finances")
     * @ORM\JoinTable(name="finances_persons")
     * @Api\Relation()
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $majorInvestors;

    /**
     * @ORM\Column(name="price_adjusted_bonus", type="decimal", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $priceAdjustedBonus;

    /**
     * Finance constructor.
     */
    public function __construct() {
        $this->majorInvestors = new ArrayCollection();
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
     * Set acceptedCurrency.
     *
     * @param array $acceptedCurrencies
     *
     * @return Finance
     */
    public function setAcceptedCurrency($acceptedCurrencies): self
    {
        $this->acceptedCurrencies = $acceptedCurrencies;

        return $this;
    }

    /**
     * Get acceptedCurrencies.
     *
     * @return array
     */
    public function getAcceptedCurrencies()
    {
        return $this->acceptedCurrencies;
    }

    /**
     * Set totalSupply.
     *
     * @param int $totalSupply
     *
     * @return Finance
     */
    public function setTotalSupply($totalSupply)
    {
        $this->totalSupply = $totalSupply;

        return $this;
    }

    /**
     * Get totalSupply.
     *
     * @return int
     */
    public function getTotalSupply()
    {
        return $this->totalSupply;
    }

    /**
     * @return int
     */
    public function getSaleSupply(): int
    {
        return $this->saleSupply;
    }

    /**
     * @param int $saleSupply
     *
     * @return self
     */
    public function setSaleSupply(int $saleSupply): self
    {
        $this->saleSupply = $saleSupply;
        return $this;
    }

    /**
     * @return integer
     */
    public function getTokensBeingSold()
    {
        return $this->tokensBeingSold;
    }

    /**
     * @param integer $tokensBeingSold
     *
     * @return self
     */
    public function setSoldTokens($tokensBeingSold): self
    {
        $this->tokensBeingSold = $tokensBeingSold;

        return $this;
    }

    /**
     * @return float
     */
    public function getHardCap(): float
    {
        return $this->hardCap;
    }

    /**
     * @param float $hardCap
     *
     * @return self
     */
    public function setHardCap(float $hardCap): self
    {
        $this->hardCap = $hardCap;

        return $this;
    }

    /**
     * @return float
     */
    public function getRaisedUsd()
    {
        return $this->raisedUsd;
    }

    /**
     * @param float $raisedUsd
     *
     * @return self
     */
    public function setRaisedUsd($raisedUsd): self
    {
        $this->raisedUsd = $raisedUsd;

        return $this;
    }

    /**
     * Set distribution.
     *
     * @param string $distribution
     *
     * @return Finance
     */
    public function setDistribution($distribution): self
    {
        $this->distribution[] = $distribution;

        return $this;
    }

    /**
     * Get distribution.
     *
     * @return array
     */
    public function getDistribution()
    {
        return $this->distribution;
    }

    /**
     * Set priceCrypto.
     *
     * @param float|null $priceCrypto
     *
     * @return Finance
     */
    public function setPriceCrypto($priceCrypto = null): self
    {
        $this->priceCrypto = $priceCrypto;

        return $this;
    }

    /**
     * Get priceCrypto.
     *
     * @return float|null
     */
    public function getPriceCrypto()
    {
        return $this->priceCrypto;
    }

    /**
     * @return Ico
     */
    public function getIco(): Ico
    {
        return $this->ico;
    }

    /**
     * @param Ico $ico
     *
     * @return self
     */
    public function setIco($ico): self
    {
        $this->ico = $ico;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDebts(): ?string
    {
        return $this->debts;
    }

    /**
     * @param string|null $debts
     */
    public function setDebts($debts = null)
    {
        $this->debts = $debts;
    }

    /**
     * @return string|null
     */
    public function getHistoryOfBankruptcy()
    {
        return $this->historyOfBankruptcy;
    }

    /**
     * @param string|null $history_of_bankruptcy
     */
    public function setHistoryOfBankruptcy($history_of_bankruptcy = null)
    {
        $this->historyOfBankruptcy = $history_of_bankruptcy;
    }

    /**
     * @return string
     */
    public function getVestedTokens()
    {
        return $this->vestedTokens;
    }

    /**
     * @param string $vested_token
     *
     * @return self
     */
    public function setVestedToken($vested_token): self
    {
        $this->vestedTokens = $vested_token;
        return $this;
    }

    /**
     * @return array
     */
    public function getBonuses()
    {
        return $this->bonuses;
    }

    /**
     * @param string $bonus
     */
    public function addBonus($bonus)
    {
        $this->bonuses[] = $bonus;
    }

    /**
     * @return mixed
     */
    public function getCirculatingSupply()
    {
        return $this->circulatingSupply;
    }

    /**
     * @param mixed $circulatingSupply
     * @return self
     */
    public function setCirculatingSupply($circulatingSupply)
    {
        $this->circulatingSupply = $circulatingSupply;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdvisorsVestingClif()
    {
        return $this->advisorsVestingClif;
    }

    /**
     * @param mixed $advisorsVestingClif
     * @return self
     */
    public function setAdvisorsVestingClif($advisorsVestingClif)
    {
        $this->advisorsVestingClif = $advisorsVestingClif;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCrowdsaleSoldTokens()
    {
        return $this->crowdsaleSoldTokens;
    }

    /**
     * @param mixed $crowdsaleSoldTokens
     * @return self
     */
    public function setCrowdsaleSoldTokens($crowdsaleSoldTokens)
    {
        $this->crowdsaleSoldTokens = $crowdsaleSoldTokens;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIndividualCap()
    {
        return $this->individualCap;
    }

    /**
     * @param mixed $individualCap
     * @return self
     */
    public function setIndividualCap($individualCap)
    {
        $this->individualCap = $individualCap;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getMinCap()
    {
        return $this->minCap;
    }

    /**
     * @param float|null $minCap
     * @return self
     */
    public function setMinCap($minCap)
    {
        $this->minCap = $minCap;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPresaleContributorsVestingClif()
    {
        return $this->presaleContributorsVestingClif;
    }

    /**
     * @return mixed
     */
    public function getPresaleSoldTokens()
    {
        return $this->presaleSoldTokens;
    }

    /**
     * @param mixed $presaleSoldTokens
     * @return self
     */
    public function setPresaleSoldTokens($presaleSoldTokens)
    {
        $this->presaleSoldTokens = $presaleSoldTokens;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrivateSoldTokens()
    {
        return $this->privateSoldTokens;
    }

    /**
     * @param mixed $privateSoldTokens
     * @return self
     */
    public function setPrivateSoldTokens($privateSoldTokens)
    {
        $this->privateSoldTokens = $privateSoldTokens;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTeamVestingClif()
    {
        return $this->teamVestingClif;
    }

    /**
     * @param mixed $teamVestingClif
     * @return self
     */
    public function setTeamVestingClif($teamVestingClif)
    {
        $this->teamVestingClif = $teamVestingClif;
        return $this;
    }

    /**
     * @return int
     */
    public function getTokensToTeam()
    {
        return $this->tokensToTeam;
    }

    /**
     * @param int $tokensToTeam
     * @return self
     */
    public function setTokensToTeam($tokensToTeam)
    {
        $this->tokensToTeam = $tokensToTeam;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalSupplyValuation()
    {
        return $this->totalSupplyValuation;
    }

    /**
     * @param mixed $totalSupplyValuation
     * @return self
     */
    public function setTotalSupplyValuation($totalSupplyValuation)
    {
        $this->totalSupplyValuation = $totalSupplyValuation;
        return $this;
    }

    /**
     * @param mixed $presaleContributorsVestingClif
     * @return self
     */
    public function setPresaleContributorsVestingClif($presaleContributorsVestingClif)
    {
        $this->presaleContributorsVestingClif = $presaleContributorsVestingClif;
        return $this;
    }

    /**
     * @param mixed $vested_tokens
     * @return self
     */
    public function setVestedTokens($vested_tokens)
    {
        $this->vested_tokens = $vested_tokens;
        return $this;
    }

    /**
     * @return integer
     */
    public function getDayToLiquidity()
    {
        return $this->dayToLiquidity;
    }

    /**
     * @param int $dayToLiquidity
     * @return self
     */
    public function setDayToLiquidity($dayToLiquidity)
    {
        $this->dayToLiquidity = $dayToLiquidity;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getMajorInvestors()
    {
        return $this->majorInvestors;
    }

    /**
     * @param Person $majorInvestor
     * @return self
     */
    public function setMajorInvestor(Person $majorInvestor)
    {
        $this->majorInvestors[] = $majorInvestor;
        return $this;
    }

    /**
     * @param Person $majorInvestor
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeMajorInvestor(Person $majorInvestor)
    {
        $this->majorInvestors->removeElement($majorInvestor);
    }

    /**
     * @return float
     */
    public function getPriceAdjustedBonus()
    {
        return $this->priceAdjustedBonus;
    }

    /**
     * @param float $priceAdjustedBonus
     * @return self
     */
    public function setPriceAdjustedBonus($priceAdjustedBonus)
    {
        $this->priceAdjustedBonus = $priceAdjustedBonus;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getTokenPriceEth(): ?float
    {
        return $this->tokenPriceEth;
    }

    /**
     * @param float $tokenPriceEth
     * @return self
     */
    public function setTokenPriceEth($tokenPriceEth)
    {
        $this->tokenPriceEth = $tokenPriceEth;
        return $this;
    }

    /**
     * @return float | null
     */
    public function getHardCapEth(): ?float
    {
        return $this->hardCapEth;
    }

    /**
     * @param float $hardCapEth
     *
     * @return self
     */
    public function setHardCapEth(float $hardCapEth): self
    {
        $this->hardCapEth = $hardCapEth;
        return $this;
    }
}
