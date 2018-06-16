<?php

namespace Kami\AssetBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Kami\ContentBundle\Entity\Post;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Kami\ApiCoreBundle\Annotation as Api;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Asset
 *
 * @ORM\Entity(repositoryClass="Kami\AssetBundle\Repository\AssetRepository")
 * @ORM\Table(name="asset")
 * @UniqueEntity({"ticker"})
 * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
 * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
 */
class Asset
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank()
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     *
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="ticker", type="string", length=10)
     * @Assert\NotBlank()
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $ticker;

    /**
     * @ORM\Column(name="price", type="integer")
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\AssetBundle\Entity\TokenType", inversedBy="assets")
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $tokenType;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\ContentBundle\Entity\Post", inversedBy="assets")
     * @ORM\JoinTable(name="asset_posts")
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $posts;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Asset
     */
    public function setTitle($title)
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
     * Set ticker.
     *
     * @param string $ticker
     *
     * @return Asset
     */
    public function setTicker($ticker)
    {
        $this->ticker = $ticker;

        return $this;
    }

    /**
     * Get ticker.
     *
     * @return string
     */
    public function getTicker()
    {
        return $this->ticker;
    }

    /**
     * Set price.
     *
     * @param int $price
     *
     * @return Asset
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price.
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set tokenType.
     *
     * @param \Kami\AssetBundle\Entity\TokenType|null $tokenType
     *
     * @return Asset
     */
    public function setTokenType(\Kami\AssetBundle\Entity\TokenType $tokenType = null)
    {
        $this->tokenType = $tokenType;

        return $this;
    }

    /**
     * Get tokenType.
     *
     * @return \Kami\AssetBundle\Entity\TokenType|null
     */
    public function getTokenType()
    {
        return $this->tokenType;
    }

    /**
     * Add post.
     *
     * @param \Kami\ContentBundle\Entity\Post $post
     *
     * @return Asset
     */
    public function addPost(\Kami\ContentBundle\Entity\Post $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove post.
     *
     * @param \Kami\ContentBundle\Entity\Post $post
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePost(\Kami\ContentBundle\Entity\Post $post)
    {
        return $this->posts->removeElement($post);
    }

    /**
     * Get posts.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
