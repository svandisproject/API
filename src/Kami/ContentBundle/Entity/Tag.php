<?php

namespace Kami\ContentBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Kami\ApiCoreBundle\Annotation as Api;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMS;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity(repositoryClass="Kami\ContentBundle\Repository\TagRepository")
 * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeEditedBy({"ROLE_ADMIN"})
 * @JMS\ExclusionPolicy("all")
 * @UniqueEntity({"title"})
 */
class Tag
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @JMS\Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @JMS\Expose(if="service('kami_api_core.access_manager').canAccessProperty(object, context, property_metadata)")
     */
    private $title;


    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Kami\ContentBundle\Entity\WebsitePost", mappedBy="tags")
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @JMS\Expose(if="service('kami_api_core.access_manager').canAccessProperty(object, context, property_metadata)")
     */
    private $websitePosts;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->websitePosts = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Tag
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
     * Add websitePost.
     *
     * @param \Kami\ContentBundle\Entity\WebsitePost $websitePost
     *
     * @return Tag
     */
    public function addWebsitePost(\Kami\ContentBundle\Entity\WebsitePost $websitePost)
    {
        $this->websitePosts[] = $websitePost;

        return $this;
    }

    /**
     * Remove websitePost.
     *
     * @param \Kami\ContentBundle\Entity\WebsitePost $websitePost
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeWebsitePost(\Kami\ContentBundle\Entity\WebsitePost $websitePost)
    {
        return $this->websitePosts->removeElement($websitePost);
    }

    /**
     * Get websitePosts.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWebsitePosts()
    {
        return $this->websitePosts;
    }
}
