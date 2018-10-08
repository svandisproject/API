<?php

namespace Kami\ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Kami\UserBundle\Entity\User;
use Kami\ApiCoreBundle\Annotation as Api;

/**
 * Like
 *
 * @ORM\Table(name="post_liked_by")
 * @ORM\Entity(repositoryClass="Kami\ContentBundle\Repository\LikeRepository")
 * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
 * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
 * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
 */
class Like
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\AnonymousAccess
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\UserBundle\Entity\User", inversedBy="likedPosts")
     * @ORM\JoinColumn(name="liked_user_id", referencedColumnName="id")
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\ContentBundle\Entity\Post", inversedBy="likedBy")
     * @ORM\JoinColumn(name="liked_post_id", referencedColumnName="id")
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $post;


    /**
     * @return Post
     */
    public function getPost()
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

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return self
     */
    public function setUser($user): self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

}
