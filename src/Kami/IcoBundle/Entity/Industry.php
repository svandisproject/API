<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Kami\ApiCoreBundle\Annotation as Api;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Industry
 *
 * @ORM\Table(name="industry")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\IndustryRepository")
 * @UniqueEntity({"title"})
 * @Api\AnonymousAccess()
 * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
 * @Gedmo\Loggable
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
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $title;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Ico", mappedBy="industries")
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\Relation()
     * @Gedmo\Versioned
     */
    private $icos;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->icos = new ArrayCollection();
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
     * Add ico.
     *
     * @param \Kami\IcoBundle\Entity\Ico $ico
     *
     * @return Industry
     */
    public function addIco(\Kami\IcoBundle\Entity\Ico $ico)
    {
        $this->icos[] = $ico;

        return $this;
    }

    /**
     * Remove ico.
     *
     * @param \Kami\IcoBundle\Entity\Ico $ico
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeIco(\Kami\IcoBundle\Entity\Ico $ico)
    {
        return $this->icos->removeElement($ico);
    }

    /**
     * Get icos.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIcos()
    {
        return $this->icos;
    }
}
