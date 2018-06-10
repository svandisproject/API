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
     * @ORM\Column(name="token_sale_date", type="datetime", nullable=true)
     */
    private $tokenSaleDate;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Person")
     */
    private $team;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Person")
     */
    private $advisors;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Ico")
     */
    private $partners;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Ico")
     */
    private $competitors;
}
