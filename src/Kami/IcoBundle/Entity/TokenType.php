<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="token_type")
 */
class TokenType
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="title", length=100)
     */
    protected $title;

    /**
     * @ORM\OneToMany(targetEntity="Kami\IcoBundle\Entity\Ico", mappedBy="tokenType", cascade={"persist"})
     */
    protected $icos;

    public function __construct()
    {
        $this->icos = new ArrayCollection();
    }

    /**
     * Set title.
     *
     * @param $title
     *
     * @return TokenType
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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add $ico.
     * @param Ico $ico
     *
     * @return TokenType
     */
    public function addIco(Ico $ico)
    {
        $this->icos[] = $ico;
        return $this;
    }

    /**
     * Get icos.
     *
     * @return ArrayCollection
     */
    public function getIco()
    {
        return $this->icos;
    }

    /**
     * Remove ico
     *
     * @param Ico $ico
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeIco(Ico $ico)
    {
        return $this->icos->removeElement($ico);
    }


}
