<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Kami\ApiCoreBundle\Annotation as Api;

/**
 * SaleStage
 *
 * @ORM\Table(name="sale_stage")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\SaleStageRepository")
 * @UniqueEntity({"title"})
 * @Api\AnonymousAccess()
 * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
 */
class SaleStage
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
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="Kami\IcoBundle\Entity\Ico", mappedBy="saleStage")
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
     * @return SaleStage
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
     * @return self
     */
    public function addIco(Ico $ico): self
    {
        $this->icos[] = $ico;

        return $this;
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
