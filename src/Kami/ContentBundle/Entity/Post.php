<?php

namespace Kami\ContentBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Kami\AssetBundle\Entity\Asset;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Kami\ApiCoreBundle\Annotation as Api;
use JMS\Serializer\Annotation\MaxDepth;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="Kami\ContentBundle\Repository\PostRepository")
 * @UniqueEntity("url")
 * @Api\Access({"ROLE_ADMIN", "ROLE_USER", "ROLE_WORKER"})
 * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_USER"})
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
     * @ORM\Column(name="published_at", type="datetime")
     * @Assert\NotBlank()
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\Form(type="Symfony\Component\Form\Extension\Core\Type\DateTimeType",
     *     options={"widget": "single_text"})
     */
    private $publishedAt;

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
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Kami\ContentBundle\Entity\Tag", inversedBy="posts", cascade={"persist"})
     * @ORM\JoinTable(name="post_tags")
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\Relation
     */
    private $tags;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Kami\ContentBundle\Entity\TagAddedBy", mappedBy="post", cascade={"persist"})
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Api\Relation
     * @MaxDepth(3)
     */
    private $tagsAddedBy;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\WorkerBundle\Entity\Worker")
     * @Api\Relation()
     * @ORM\JoinColumn(name="created_by", referencedColumnName="id")
     */
    private $createdBy;


    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Kami\WorkerBundle\Entity\Worker", inversedBy="validatedPosts")
     * @Api\Relation()
     * @ORM\JoinTable(name="worker_validated_posts")
     */
    private $validatedBy;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\AssetBundle\Entity\Asset", mappedBy="posts")
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\Relation
     */
    private $assets;

    /**
     * @ORM\OneToMany(targetEntity="Kami\ContentBundle\Entity\Like", mappedBy="post", cascade={"persist"})
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\Relation
     */
    private $likedBy;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->tagsAddedBy = new ArrayCollection();
        $this->validatedBy = new ArrayCollection();
        $this->assets = new ArrayCollection();
        $this->likedBy = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getLikedBy()
    {
        return $this->likedBy;
    }

    /**
     * @param Like $like
     * @return $this
     */
    public function addLikedBy($like)
    {
        if(!$this->likedBy->contains($like))
        {
            $this->likedBy[] = $like;
            $like->setPost($this);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function setLikedBy($likedBy)
    {
        $this->likedBy = $likedBy;

        return $this;
    }

    /**
     * @param Like $like
     * @return $this
     */
    public function removeLikedBy(Like $like)
    {
        if($this->likedBy->contains($like))
        {
            $this->likedBy->removeElement($like);
        }

        return $this;
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
     * @param Tag $tag
     *
     * @return Post
     */
    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addPost($this);
        }
        return $this;
    }

    /**
     * @param  ArrayCollection
     * @return $this
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * Remove tag.
     *
     * @param $tag
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTag($tag)
    {
        return $this->tags->removeElement($tag);
    }

    /**
     * @return ArrayCollection
     */
    public function getTagsAddedBy()
    {
        return $this->tagsAddedBy;
    }

    /**
     * @param TagAddedBy $tagAddedBy
     * @return Post
     */
    public function addTagAddedBy($tagAddedBy): self
    {
            $this->tagsAddedBy[] = $tagAddedBy;

         return $this;
    }

    /**
     * @param ArrayCollection $tagsAddedBy
     *
     * @return Post
     */
    public function setTagsAddedBy ($tagsAddedBy): self
    {
        $this->tagsAddedBy = $tagsAddedBy;

        return $this;
    }


    /**
     * @param TagAddedBy $tagsAddedBy
     * @return boolean
     */
    public function removeTagsAddedBy ($tagsAddedBy)
    {
        return $this->tagsAddedBy->removeElement($tagsAddedBy);
    }

    /**
     * Get tags.
     *
     * @return ArrayCollection
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

}
