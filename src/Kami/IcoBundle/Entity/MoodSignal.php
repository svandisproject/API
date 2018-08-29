<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * MoodSignal
 *
 * @ORM\Table(name="mood_signal")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\MoodSignalRepository")
 * @UniqueEntity({"title"})
 * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
 * @Api\AnonymousAccess()
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
 */
class MoodSignal
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
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="Kami\IcoBundle\Entity\IcoValues", mappedBy="moodSignal")
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $icoValues;

    /**
     * MoodSignal constructor.
     */
    function __construct()
    {
        $this->icoValues = new ArrayCollection();
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
     * @return MoodSignal
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
     * @return ArrayCollection
     */
    public function getIcoValues()
    {
        return $this->icoValues;
    }

    /**
     * @param IcoValues $icoValues
     * @return self
     */
    public function setIcoValues($icoValues)
    {
        $this->icoValues = $icoValues;
        return $this;
    }
}
