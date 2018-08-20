<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Kami\AssetBundle\Entity\Asset;

/**
 * Finance
 *
 * @ORM\Table(name="finance")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\FinanceRepository")
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
     * @var string
     *
     * @ORM\Column(name="token_type_standart", type="string", length=100)
     */
    private $tokenTypeStandart;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\AssetBundle\Entity\Asset")
     * @ORM\JoinTable(name="accepted_assets", joinColumns={@ORM\JoinColumn(name="finance_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="asset_id", referencedColumnName="id")})
     */
    private $acceptedCurrencies;

    /**
     * @var int
     *
     * @ORM\Column(name="total_supply", type="integer")
     */
    private $totalSupply;

    /**
     * @var array
     *
     * @ORM\Column(name="distribution", type="array")
     */
    private $distribution;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bounties", type="string", length=255, nullable=true)
     */
    private $bounties;

    /**
     * @var string|null
     *
     * @ORM\Column(name="airdrops", type="string", length=255, nullable=true)
     */
    private $airdrops;

    /**
     * @var float|null
     *
     * @ORM\Column(name="price_crypto", type="float", nullable=true)
     */
    private $priceCrypto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $debts;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $history_of_bankruptcy;

    /**
     * @ORM\OneToOne(targetEntity="Kami\IcoBundle\Entity\Ico", inversedBy="finance")
     */
    private $ico;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $vested_tokens;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $bonuses;

    public function __construct() {
        $this->acceptedCurrencies = new ArrayCollection();
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
     * Set tokenTypeStandart.
     *
     * @param string $tokenTypeStandart
     *
     * @return Finance
     */
    public function setTokenTypeStandart($tokenTypeStandart)
    {
        $this->tokenTypeStandart = $tokenTypeStandart;

        return $this;
    }

    /**
     * Get tokenTypeStandart.
     *
     * @return string
     */
    public function getTokenTypeStandart()
    {
        return $this->tokenTypeStandart;
    }

    /**
     * Set acceptedCurrency.
     *
     * @param Asset $acceptedCurrency
     *
     * @return Finance
     */
    public function setAcceptedCurrency($acceptedCurrency): self
    {
        $this->acceptedCurrencies[] = $acceptedCurrency;

        return $this;
    }

    /**
     * Get acceptedCurrencies.
     *
     * @return ArrayCollection
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
     * Set distribution.
     *
     * @param string $distribution
     *
     * @return Finance
     */
    public function setDistribution($distribution)
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
     * Set bounties.
     *
     * @param string|null $bounties
     *
     * @return Finance
     */
    public function setBounties($bounties = null)
    {
        $this->bounties = $bounties;

        return $this;
    }

    /**
     * Get bounties.
     *
     * @return string|null
     */
    public function getBounties()
    {
        return $this->bounties;
    }

    /**
     * Set airdrops.
     *
     * @param string|null $airdrops
     *
     * @return Finance
     */
    public function setAirdrops($airdrops = null)
    {
        $this->airdrops = $airdrops;

        return $this;
    }

    /**
     * Get airdrops.
     *
     * @return string|null
     */
    public function getAirdrops()
    {
        return $this->airdrops;
    }

    /**
     * Set priceCrypto.
     *
     * @param float|null $priceCrypto
     *
     * @return Finance
     */
    public function setPriceCrypto($priceCrypto = null)
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
        return $this->history_of_bankruptcy;
    }

    /**
     * @param string|null $history_of_bankruptcy
     */
    public function setHistoryOfBankruptcy($history_of_bankruptcy = null)
    {
        $this->history_of_bankruptcy = $history_of_bankruptcy;
    }

    /**
     * @return array
     */
    public function getVestedTokens()
    {
        return $this->vested_tokens;
    }

    /**
     * @param string $vested_token
     */
    public function setVestedToken($vested_token)
    {
        $this->vested_tokens[] = $vested_token;
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
    public function setBonus($bonus)
    {
        $this->bonuses[] = $bonus;
    }
}
