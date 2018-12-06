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
 * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=16)
     */
    private $workerToken;

    /**
     * @ORM\Column(name="onboarded", type="boolean", nullable=true)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN", "ROLE_USER"})
     */
    private $onboarded = false;

    /**
     * @ORM\Column(name="centralized", type="boolean", nullable=true)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN", "ROLE_USER"})
     */
    private $centralized = false;


    /**
     * @ORM\Column(name="key_addresses", type="array", nullable=true)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN", "ROLE_USER"})
     */
    private $keyAddresses;

    /**
     * @ORM\Column(name="recovery_addresses", type="array", nullable=true)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN", "ROLE_USER"})
     */
    private $recoveryAddresses;

    /**
     * @ORM\Column(name="identity_address", type="string", length=150, nullable=true)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN", "ROLE_USER"})
     */
    private $identityAddress;

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

    /**
     * @return bool|null
     */
    public function getOnboarded()
    {
        return $this->onboarded;
    }

    /**
     * @param boolean $onboarded|null
     * @return self
     */
    public function setOnboarded($onboarded = false)
    {
        $this->onboarded = $onboarded;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getCentralized()
    {
        return $this->centralized;
    }

    /**
     * @param bool $centralized|null
     * @return self
     */
    public function setCentralized($centralized = false)
    {
        $this->centralized = $centralized;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getKeyAddresses()
    {
        return $this->keyAddresses;
    }

    /**
     * @param array $keyAddresses|null
     */
    public function setKeyAddresses($keyAddresses)
    {
        $this->keyAddresses = $keyAddresses;
    }

    /**
     * @return string|null
     */
    public function getIdentityAddress()
    {
        return $this->identityAddress;
    }

    /**
     * @param string $identityAddress|null
     * @return self
     */
    public function setIdentityAddress($identityAddress)
    {
        $this->identityAddress = $identityAddress;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRecoveryAddresses()
    {
        return $this->recoveryAddresses;
    }

    /**
     * @param array $recoveryAddresses|null
     * @return self
     */
    public function setRecoveryAddresses($recoveryAddresses)
    {
        $this->recoveryAddresses = $recoveryAddresses;

        return $this;
    }

}
