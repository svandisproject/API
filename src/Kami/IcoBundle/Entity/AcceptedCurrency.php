<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * AcceptedCurrency
 *
 * @ORM\Table(name="accepted_currency")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\AcceptedCurrencyRepository")
 */
class AcceptedCurrency
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
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\IcoScreener", mappedBy="acceptedCurrencies")
     */
    private $icoScreeners;

    public function __construct() {
        $this->icoScreeners = new ArrayCollection();
    }

    /**
     * Add icoScreener.
     *
     * @param IcoScreener $icoScreener
     */
    public function addIcoScreener(IcoScreener $icoScreener)
    {
        $icoScreener->addAcceptedCurrency($this);
        $this->icoScreeners[] = $icoScreener;
    }

    /**
     * Remove icoScreener.
     *
     * @param IcoScreener $icoScreener
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeIcoScreener(IcoScreener $icoScreener)
    {
        return $this->icoScreeners->removeElement($icoScreener);
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
     * @return AcceptedCurrency
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
