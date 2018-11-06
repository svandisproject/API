<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Kami\ApiCoreBundle\Annotation as Api;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Person
 *
 * @ORM\Table(name="person")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\PersonRepository")
 * @UniqueEntity({"url"})
 * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
 * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
 * @Gedmo\Loggable
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
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $nationality;

    /**
     * @ORM\Column(name="links", type="array", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $links;

    /**
     * @ORM\Column(name="url", type="string", length=255, unique=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $url;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $kyc = false;

    /**
     * @ORM\Column(type="array", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $relevantExperience;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\IcoBundle\Entity\Department", inversedBy="persons", cascade={"persist"})
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $department;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Finance", mappedBy="majorInvestors")
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $finances;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $advisor = false;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Ico", mappedBy="team", cascade={"persist"})
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $icos;

    /**
     * Person constructor.
     */
    function __construct()
    {
        $this->icos = new ArrayCollection();
        $this->finances = new ArrayCollection();
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
     * @param array|null $links
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
    public function getLinks(): ?array
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
     * @return boolean|null
     */
    public function getKyc(): ?bool
    {
        return $this->kyc;
    }

    /**
     * @param boolean $kyc
     *
     * @return self
     */
    public function setKyc($kyc = false): self
    {
        $this->kyc = $kyc;
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
        return $this->relevantExperience;
    }

    /**
     * @param string $relevant_experience
     */
    public function addRelevantExperience($relevant_experience)
    {
        $this->relevantExperience[] = $relevant_experience;
    }

    /**
     * @param Ico $ico
     * @return self
     */
    public function addIco($ico)
    {
        $this->icos[] = $ico;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getIcos()
    {
        return $this->icos;
    }

    /**
     * remove Ico
     * @param Ico $ico
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeIco(Ico $ico)
    {
        $this->icos->removeElement($ico);
    }

    /**
     * @return ArrayCollection
     */
    public function getFinances()
    {
        return $this->finances;
    }

    /**
     * @param Finance $finance
     * @return self
     */
    public function addFinance($finance)
    {
        $this->finances[] = $finance;
        return $this;
    }

    /**
     * @param Finance $finance
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeMajorInvestor(Finance $finance)
    {
        $this->finances->removeElement($finance);
    }

    /**
     * @return string|null
     */
    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @param bool $advisor
     * @return self
     */
    public function setAdvisor(bool $advisor)
    {
        $this->advisor = $advisor;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAdvisor(): bool
    {
        return $this->advisor;
    }
}
