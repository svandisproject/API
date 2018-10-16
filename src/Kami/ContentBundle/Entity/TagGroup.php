<?php


namespace Kami\ContentBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use const false;
use Kami\ApiCoreBundle\Annotation as Api;
use Kami\ContentBundle\Entity\Tag;

/**
 * TagGroup
 *
 * @ORM\Table(name="tag_group")
 * @ORM\Entity(repositoryClass="Kami\ContentBundle\Repository\TagGroupRepository")
 * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
 * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
 */
class TagGroup
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $title;

    /**
     * @ORM\Column(type="boolean")
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $enabled;

    /**
     * @ORM\OneToMany(targetEntity="Kami\ContentBundle\Entity\Tag", mappedBy="group")
     * @Api\Relation()
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $tags;

    /**
     * TagGroup constructor.
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param boolean $enabled
     */
    public function setEnabled($enabled = false)
    {
        $this->enabled = $enabled;
    }

    /**
     * @return ArrayCollection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param Tag $tag
     * @return self
     */
    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags = $tag;
            $tag->setGroup = $this;
        }
        return $this;
    }

}