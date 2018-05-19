<?php

namespace Kami\AssetBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Kami\ContentBundle\Entity\Post;
use Kami\IcoBundle\Entity\Ico;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Asset
 * @ORM\Entity
 * @ORM\Table(name="asset")
 * @UniqueEntity("title")
 */
class Asset
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Ico", inversedBy="assets")
     * @ORM\JoinTable(name="assets_icos")
     */
    private $icos;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\ContentBundle\Entity\Post", inversedBy="assets")
     * @ORM\JoinTable(name="assets_posts")
     */
    private $posts;

    public function __construct() {
        $this->posts = new ArrayCollection();
        $this->icos = new ArrayCollection();
    }

    /**
     * Add post.
     *
     * @param Post $post
     *
     * @return Asset
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
     * Get posts.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Add ico.
     *
     * @param Ico $ico
     *
     * @return Asset
     */
    public function addIco(Ico $ico)
    {
        $this->icos[] = $ico;

        return $this;
    }

    /**
     * Remove ico.
     *
     * @param Ico $ico
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeIco(Ico $ico)
    {
        return $this->icos->removeElement($ico);
    }

    /**
     * Get icos.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIcos()
    {
        return $this->icos;
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
}
