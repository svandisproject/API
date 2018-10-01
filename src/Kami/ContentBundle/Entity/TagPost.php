<?php

namespace Kami\ContentBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Kami\ApiCoreBundle\Annotation as Api;
use Kami\UserBundle\Entity\User;

/**
 * TagPost
 *
 * @ORM\Table(name="tag_post")
 * @ORM\Entity(repositoryClass="Kami\ContentBundle\Repository\TagPostRepository")
 * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
 * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
 */
class TagPost
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
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Kami\ContentBundle\Entity\Post", mappedBy="tags")
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $posts;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\UserBundle\Entity\User", inversedBy="tagPost")
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\ContentBundle\Entity\Tag", inversedBy="tagPost")
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $tag;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new ArrayCollection();
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
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser() :User
    {
        return $this->user;
    }

    /**
     * @param Tag $tag
     */
    public function setTag(Tag $tag): void
    {
        $this->tag = $tag;
    }

    /**
     * @return Tag
     */
    public function getTag() :Tag
    {
        return $this->tag;
    }

    /**
     * Add post.
     *
     * @param Post $post
     *
     * @return TagPost
     */
    public function addPost(Post $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove post.
     *
     * @param Post $post
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePost(Post $post)
    {
        return $this->posts->removeElement($post);
    }

    /**
     * Get Posts.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
