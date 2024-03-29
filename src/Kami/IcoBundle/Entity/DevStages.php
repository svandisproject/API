<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Kami\ApiCoreBundle\Annotation as Api;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * DevStages
 *
 * @ORM\Table(name="dev_stages")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\DevStagesRepository")
 * @UniqueEntity({"title"})
 * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
 * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
 * @Gedmo\Loggable
 */
class DevStages
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
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\IcoBundle\Entity\Development", inversedBy="stages")
     * @ORM\JoinColumn(name="development_id", referencedColumnName="id")
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $development;


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
     * @return DevStages
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
     * @return Development | null
     */
    public function getDevelopment(): ?Development
    {
        return $this->development;
    }

    /**
     * @param Development $development | null
     * @return self
     */
    public function setDevelopment(Development $development = null): self
    {
        $this->development = $development;
        return $this;
    }
}
