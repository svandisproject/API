<?php

namespace Kami\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Kami\ContentBundle\Entity\Like;
use Kami\Util\TokenGenerator;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Kami\ApiCoreBundle\Annotation as Api;
use JMS\Serializer\Annotation\Exclude;


/**
 * @ORM\Entity
 * @ORM\Table(name="`user`")
 * @UniqueEntity("workerToken")
 * @Api\Access({"ROLE_ADMIN"})
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Api\Access({"ROLE_ADMIN"})
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=16)
     */
    private $workerToken;

    /**
     * @ORM\OneToMany(targetEntity="Kami\ContentBundle\Entity\Like", mappedBy="user", cascade={"persist"})
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_USER", "ROLE_ADMIN"})
     * @Exclude()
     */
    private $likedPosts;

    /**
     * @ORM\OneToMany(targetEntity="Kami\ContentBundle\Entity\TagAddedBy", mappedBy="user")
     * @Api\Relation()
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_USER", "ROLE_ADMIN"})
     * @Exclude()
     */
    private $addedTags;

    public function __construct()
    {
        $this->workerToken = TokenGenerator::generate(16);
        $this->likedPosts = new ArrayCollection();
        $this->addedTags = new ArrayCollection();
        parent::__construct();
    }

    /**
     * @return ArrayCollection
     */
    public function getLikedPosts()
    {
        return $this->likedPosts;
    }

    /**
     * @param Like $like
     * @return $this
     */
    public function addLikedPost(Like $like)
    {
        if(!$this->likedPosts->contains($like))
        {
            $this->likedPosts[] = $like;
            $like->setUser($this);
        }

        return $this;
    }

    /**
     * @param Like $like
     * @return $this
     */
    public function removeLikedPost(Like $like)
    {
        if($this->likedPosts->contains($like))
        {
            $this->likedPosts->removeElement($like);
        }

        return $this;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        parent::setEmail($email);
        $this->setUsername($email);

        return $this;
    }

    /**
     * @return string
     */
    public function getWorkerToken()
    {
        return $this->workerToken;
    }

    /**
     * @param string $workerToken
     * @return User
     */
    public function setWorkerToken($workerToken)
    {
        $this->workerToken = $workerToken;

        return $this;
    }

    public function updateWorkerToken()
    {
        $this->workerToken = TokenGenerator::generate(16);
    }
}
