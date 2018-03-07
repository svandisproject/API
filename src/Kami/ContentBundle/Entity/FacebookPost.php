<?php

namespace Kami\ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Kami\ApiCoreBundle\Annotation as Api;

/**
 * WebsitePost
 *
 * @ORM\Table(name="facebook_post")
 * @ORM\Entity(repositoryClass="Kami\ContentBundle\Repository\FacebookPostRepository")
 * @UniqueEntity("facebook_id")
 * @Api\Access({"ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_WORKER"})
 */
class FacebookPost
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Assert\NotBlank()
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_id", type="string", length=100)
     * @Assert\NotBlank()
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER"})
     */
    private $facebookId;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="text")
     * @Assert\NotBlank()
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER"})
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\NotBlank()
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER"})
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     * @Api\Access({"ROLE_ADMIN"})
     */
    private $createdAt;



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
     * Set facebookId.
     *
     * @param int $facebookId
     *
     * @return FacebookPost
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;

        return $this;
    }

    /**
     * Get facebookId.
     *
     * @return int
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * Set author.
     *
     * @param string $author
     *
     * @return FacebookPost
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author.
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set content.
     *
     * @param string $content
     *
     * @return FacebookPost
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return FacebookPost
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
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
