<?php

namespace Kami\ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kami\UserBundle\Entity\User;
use Kami\ApiCoreBundle\Annotation as Api;

/**
 * PostTag
 *
 * @ORM\Table(name="post_tag")
 * @ORM\Entity(repositoryClass="Kami\ContentBundle\Repository\PostTagRepository")
 * @Api\Access({"ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_USER"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_USER"})
 * @Api\CanBeDeletedBy({"ROLE_ADMIN", "ROLE_USER"})
 */
class PostTag
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
     * @ORM\ManyToOne(targetEntity="Kami\ContentBundle\Entity\Post", inversedBy="postTags")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     * @Api\Relation()
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN", "ROLE_USER"})
     */
    private $post;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\UserBundle\Entity\User", inversedBy="postTags")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @Api\Relation()
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN", "ROLE_USER"})
     */
    private $user;
    /**
     * @ORM\ManyToOne(targetEntity="Kami\ContentBundle\Entity\Tag", inversedBy="postTags")
     * @ORM\JoinColumn(name="tag_id", referencedColumnName="id")
     * @Api\Relation()
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN", "ROLE_USER"})
     */
    private $tag;

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
     * @return self
     */
    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser() :User
    {
        return $this->user;
    }

    /**
     * @param  Tag $tag
     * @return $this
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * @return Tag
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Get Post.
     *
     * @return Post
     */
    public function getPost(): Post
    {
        return $this->post;
    }
    /**
     * @param Post $post
     * @return self
     */
    public function setPost(Post $post): self
    {
        $this->post = $post;

        return $this;
    }
}
