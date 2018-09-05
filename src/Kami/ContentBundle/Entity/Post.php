<?php

namespace Kami\ContentBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Kami\AssetBundle\Entity\Asset;
use Kami\WorkerBundle\Entity\Worker;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Kami\ApiCoreBundle\Annotation as Api;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="Kami\ContentBundle\Repository\PostRepository")
 * @UniqueEntity("url")
 * @Api\Access({"ROLE_ADMIN", "ROLE_USER", "ROLE_WORKER"})
 * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
 * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
 */
class Post
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank()
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, unique=true)
     * @Assert\Url()
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER", "ROLE_WORKER"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN", "ROLE_WORKER"})
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\NotBlank()
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="string", length=255)
     * @Assert\NotBlank()
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $source;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publishedAt", type="datetime")
     * @Assert\NotBlank()
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\Form(type="Symfony\Component\Form\Extension\Core\Type\DateTimeType",
     *     options={"widget": "single_text"})
     */
    private $publishedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     * @Gedmo\Timestampable(on="create")
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\AnonymousAccess
     */
    private $createdAt;


    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Kami\ContentBundle\Entity\Tag", inversedBy="posts")
     * @ORM\JoinTable(name="post_tags")
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\Relation
     */
    private $tags;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\WorkerBundle\Entity\Worker")
     * @ORM\JoinColumn(name="created_by", referencedColumnName="id")
     */
    private $createdBy;


    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Kami\WorkerBundle\Entity\Worker", inversedBy="validatedPosts")
     * @ORM\JoinTable(name="worker_validated_posts")
     */
    private $validatedBy;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\AssetBundle\Entity\Asset", mappedBy="posts")
     */
    private $assets;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\IcoBundle\Entity\Ico", inversedBy="icoNews")
     * @ORM\JoinColumn(name="ico_id", referencedColumnName="id")
     */
    private $ico;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->validatedBy = new ArrayCollection();
        $this->assets = new ArrayCollection();
    }

    /**
     * Add asset.
     *
     * @param Asset $asset
     *
     * @return Post
     */
    public function addAsset(Asset $asset)
    {
        $this->assets[] = $asset;

        return $this;
    }

    /**
     * Remove asset.
     *
     * @param Asset $asset
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAsset(Asset $asset)
    {
        return $this->assets->removeElement($asset);
    }

    /**
     * Get assets.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssets()
    {
        return $this->assets;
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
     * @return Post
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
     * Set url.
     *
     * @param string $url
     *
     * @return Post
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set content.
     *
     * @param string $content
     *
     * @return Post
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
     * Set source.
     *
     * @param string $source
     *
     * @return Post
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source.
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set publishedAt.
     *
     * @param $publishedAt
     *
     * @return Post
     */
    public function setPublishedAt($publishedAt)
    {
        if (!$publishedAt instanceof \DateTime) {
            $this->publishedAt = \DateTime::createFromFormat('d-m-Y g:i:s', $publishedAt);
            return $this;
        }
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get publishedAt.
     *
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return Post
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

    /**
     * Add tag.
     *
     * @param \Kami\ContentBundle\Entity\Tag $tag
     *
     * @return Post
     */
    public function addTag(\Kami\ContentBundle\Entity\Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag.
     *
     * @param \Kami\ContentBundle\Entity\Tag $tag
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTag(\Kami\ContentBundle\Entity\Tag $tag)
    {
        return $this->tags->removeElement($tag);
    }

    /**
     * Get tags.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set createdBy
     *
     * @param \Kami\WorkerBundle\Entity\Worker|null $createdBy
     *
     * @return Post
     */
    public function setCreatedBy(\Kami\WorkerBundle\Entity\Worker $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy.
     *
     * @return \Kami\WorkerBundle\Entity\Worker|null
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param $validatedBy
     * @return $this
     */
    public function setValidatedBy($validatedBy)
    {
        $this->validatedBy = $validatedBy;

        return $this;
    }

    /**
     * Add validatedBy.
     *
     * @param \Kami\WorkerBundle\Entity\Worker $validatedBy
     *
     * @return Post
     */
    public function addValidatedBy(\Kami\WorkerBundle\Entity\Worker $validatedBy)
    {
        $this->validatedBy[] = $validatedBy;

        return $this;
    }

    /**
     * Remove validatedBy.
     *
     * @param \Kami\WorkerBundle\Entity\Worker $validatedBy
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeValidatedBy(\Kami\WorkerBundle\Entity\Worker $validatedBy)
    {
        return $this->validatedBy->removeElement($validatedBy);
    }

    /**
     * Get validatedBy.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getValidatedBy()
    {
        return $this->validatedBy;
    }

    /**
     * @param $tags
     * @return $this
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
        return $this;
    }


}
