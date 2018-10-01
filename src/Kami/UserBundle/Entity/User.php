<?php

namespace Kami\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Kami\ContentBundle\Entity\TagPost;
use Kami\Util\TokenGenerator;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Kami\ApiCoreBundle\Annotation as Api;


/**
 * @ORM\Entity
 * @ORM\Table(name="`user`")
 * @UniqueEntity("workerToken")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=16)
     */
    private $workerToken;

    /**
     * @ORM\OneToMany(targetEntity="Kami\ContentBundle\Entity\TagPost", mappedBy="user")
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $tagPost;

    public function __construct()
    {
        $this->workerToken = TokenGenerator::generate(16);
        parent::__construct();
    }

    /**
     * @return TagPost
     */
    public function getTagPost() :TagPost
    {
        return $this->tagPost;
    }

    /**
     * @param TagPost $tagPost
     * @return $this
     */
    public function setTagPost(TagPost $tagPost)
    {
        $this->tagPost = $tagPost;

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
