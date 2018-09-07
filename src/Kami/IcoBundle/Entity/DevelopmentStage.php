<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * DevelopmentStage
 *
 * @ORM\Table(name="development_stage")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\DevelopmentStageRepository")
 */
class DevelopmentStage
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="Kami\IcoBundle\Entity\Development", mappedBy="development_stage")
     */
    private $developments;

    /**
     * DevelopmentStage constructor.
     */
    function __construct()
    {
        $this->developments = new ArrayCollection();
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
     * @return DevelopmentStage
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
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDevelopments()
    {
        return $this->developments;
    }

    /**
     * @param Development $development
     *
     * @return self
     */
    public function setDevelopment($development)
    {
        $this->developments = $development;

        return $this;
    }

    /**
     * Remove development.
     *
     * @param Development $development
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTeam(Development $development)
    {
        return $this->developments->removeElement($development);
    }
}
