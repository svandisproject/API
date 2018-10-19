<?php

namespace Kami\ContentBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Kami\ApiCoreBundle\Annotation as Api;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity(repositoryClass="Kami\ContentBundle\Repository\TagRepository")
 * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
 * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
 * @UniqueEntity({"title"})
 */
class Tag
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Api\AnonymousAccess
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Api\AnonymousAccess
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\ContentBundle\Entity\TagGroup", inversedBy="tags")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $group;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\ContentBundle\Entity\Post", mappedBy="tags")
     * @Api\Relation()
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN", "ROLE_USER"})
     */
    private $posts;

    /**
     * @ORM\OneToMany(targetEntity="Kami\ContentBundle\Entity\PostTag", mappedBy="tag")
     * @Api\Relation()
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN", "ROLE_USER"})
     */
    private $postTags;

    /**
     * Tag constructor.
     */
    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->postTags = new ArrayCollection();
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
     * @return Tag
     */
    public function setTitle($title): self
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
     * @return TagGroup
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param TagGroup $group | null
     * @return self
     */
    public function setGroup($group = null): self
    {
        $this->group = $group;

        return $this;
    }

    /**
     * @param ArrayCollection
     *
     * @return self
     */
    public function setPostTags($postTags): self
    {
        $this->postTags = $postTags;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getPostTags()
    {
        return $this->postTags;
    }

    /**
     * @param PostTag $postTag
     * @return Tag
     */
    public function addPostTag (PostTag $postTag): self
    {
        $this->postTags[] = $postTag;
        return $this;
    }


    /**
     * @return ArrayCollection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param ArrayCollection
     * @return self
     */
    public function setPosts($posts): self
    {
        $this->posts = $posts;
        return $this;
    }

    /**
     * @param Post $post
     * @return self
     */
    public function addPost (Post $post)
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
        }
        return $this;
    }
}
