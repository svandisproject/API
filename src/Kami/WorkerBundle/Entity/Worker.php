<?php

namespace Kami\WorkerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Kami\ApiCoreBundle\Annotation as Api;
use Kami\ContentBundle\Entity\Post;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Worker
 *
 * @ORM\Table(name="worker")
 * @ORM\Entity(repositoryClass="Kami\WorkerBundle\Repository\WorkerRepository")
 * @Api\Access({"ROLE_USER"})
 */
class Worker implements UserInterface
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->validatedPosts = new ArrayCollection();

    }

    /**
     * @ORM\ManyToOne(targetEntity="Kami\UserBundle\Entity\User")
     * @Api\Relation()
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Api\Access({"ROLE_USER"})
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="secret", type="string", length=128, unique=true)
     * @Api\Access({"ROLE_USER"})
     */
    private $secret;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_seen_at", type="datetime", nullable=true)
     * @Api\Access({"ROLE_USER"})
     */
    private $lastSeenAt;

    /**
     * @var array
     */
    private $roles = ['ROLE_WORKER'];

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Kami\ContentBundle\Entity\Post", mappedBy="validatedBy")
     * @Api\Relation()
     */
    private $validatedPosts;

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
     * Set secret.
     *
     * @param string $secret
     *
     * @return Worker
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;

        return $this;
    }

    /**
     * Get secret.
     *
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param \DateTime $lastSeenAt
     * @return Worker
     */
    public function setLastSeenAt($lastSeenAt)
    {
        $this->lastSeenAt = $lastSeenAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLastSeenAt()
    {
        return $this->lastSeenAt;
    }

    /**
     * Set user.
     *
     * @param \Kami\UserBundle\Entity\User $user
     *
     * @return Worker
     */
    public function setUser(\Kami\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \Kami\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add validatedPost
     *
     * @param \Kami\ContentBundle\Entity\Post $post
     *
     * @return \Worker
     */
    public function addValidatedPosts(\Kami\ContentBundle\Entity\Post $post)
    {
        $this->validatedPosts[] = $post;

        return $this;
    }

    /**
     * Remove validatedPost.
     *
     * @param \Kami\ContentBundle\Entity\Post $post
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeValidatedPost(\Kami\ContentBundle\Entity\Post $post)
    {
        return $this->validatedPosts->removeElement($post);
    }

    /**
     * Get validatedPosts.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getValidatedPosts()
    {
        return $this->validatedPosts;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    public function getPassword()
    {
        return;
    }

    public function getSalt()
    {
        return;
    }

    public function getUsername()
    {
        return;
    }

    public function eraseCredentials()
    {
        return;
    }
}
