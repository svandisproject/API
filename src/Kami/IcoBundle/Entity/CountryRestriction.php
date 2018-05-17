<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CountryRestriction
 *
 * @ORM\Table(name="country_restriction")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\CountryRestrictionRepository")
 */
class CountryRestriction
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
     * @ORM\Column(name="title", type="string", length=100, unique=true)
     */
    private $title;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Ico", mappedBy="countryRestrictions")
     */
    private $ico;

    public function __construct() {
        $this->ico = new ArrayCollection();
    }

    /**
     * Add ico.
     *
     * @param Ico $ico
     */
    public function addIcoScreener(Ico $ico)
    {
        $ico->addCountryRestriction($this);
        $this->ico[] = $ico;
    }

    /**
     * Remove ico.
     *
     * @param Ico $ico
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeIco(Ico $ico)
    {
        return $this->ico->removeElement($ico);
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
     * @return CountryRestriction
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
}
