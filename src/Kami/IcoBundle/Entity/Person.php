<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use const false;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Person
 *
 * @ORM\Table(name="person")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\PersonRepository")
 * @UniqueEntity({"url"})
 */
class Person
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $nationality;

    /**
     * @ORM\Column(name="links", type="string", nullable=true)
     */
    private $links;

    /**
     * @ORM\Column(name="url", type="string", unique=true)
     */
    private $url;

    /**
     * @ORM\OneToOne(targetEntity="Kami\IcoBundle\Entity\SocialMedia", mappedBy="person", cascade={"persist"})
     */
    private $social_media_links;

    /**
     * @ORM\Column(type="boolean")
     */
    private $kyc = false;

    /**
     * @ORM\Column(type="array")
     */
    private $relevant_experience;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\IcoBundle\Entity\Department", inversedBy="person", cascade={"persist"})
     */
    private $department;

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
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Person
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set links.
     *
     * @param string|null $links
     *
     * @return Person
     */
    public function setLinks($links = null)
    {
        $this->links = $links;

        return $this;
    }

    /**
     * Get links.
     *
     * @return array|null
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @param string $title
     *
     * @return self
     */
    public function setTitle($title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    /**
     * @param string $nationality
     *
     * @return self
     */
    public function setNationality($nationality): self
    {
        $this->nationality = $nationality;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getKyc(): bool
    {
        return $this->kyc;
    }

    /**
     * @param boolean $kyc
     *
     * @return self
     */
    public function setKyc($kyc): self
    {
        $this->kyc = $kyc;
        return $this;
    }

    /**
     * @return SocialMedia
     */
    public function getSocialMediaLinks()
    {
        return $this->social_media_links;
    }

    /**
     * @param SocialMedia $social_media_links
     *
     * @return self
     */
    public function setSocialMediaLinks($social_media_links)
    {
        $this->social_media_links = $social_media_links;
        return $this;
    }

    /**
     * @return Department
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @param Department $department
     *
     * @return self
     */
    public function setDepartment($department): self
    {
        $this->department = $department;
        return $this;
    }

    /**
     * @return array
     */
    public function getRelevantExperience()
    {
        return $this->relevant_experience;
    }

    /**
     * @param string $relevant_experience
     */
    public function setRelevantExperience($relevant_experience)
    {
        $this->relevant_experience[] = $relevant_experience;
    }
}
