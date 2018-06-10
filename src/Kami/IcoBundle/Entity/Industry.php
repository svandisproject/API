<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Industry
 *
 * @ORM\Table(name="industry")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\IndustryRepository")
 * @UniqueEntity({"title"})
 */
class Industry
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
     * @ORM\Column(name="title", type="string", length=100)
     */
    private $title;

    /**
     * @ORM\ManyToMany(targetEntity="IcoOld.php", mappedBy="industries")
     */
    private $icos;

    public function __construct()
    {
        $this->icos= new ArrayCollection();
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
     * @return Industry
     */
    public function setTitle($title)
    {
        $this->title= $title;

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
     * Add ico
     * @param IcoOld $ico
     * @return Industry
     */
    public function addIco(IcoOld $ico){

        $this->icos[] = $ico;
        return $this;
    }

    /**
     * Remove ico
     * @param IcoOld $ico
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeIco($ico)
    {
        return $this->icos->removeElement($ico);

    }
}
