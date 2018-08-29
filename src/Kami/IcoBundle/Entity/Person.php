<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Person
 *
 * @ORM\Table(name="person")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\PersonRepository")
 * @Api\AnonymousAccess()
 * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
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
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $nationality;

    /**
     * @ORM\Column(name="links", type="array", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $links;

    /**
     * @ORM\Column(name="url", type="string", unique=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $url;

    /**
     * @ORM\Column(type="boolean")
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $kyc = false;

    /**
     * @ORM\Column(type="array")
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $relevantExperience;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\IcoBundle\Entity\Department", inversedBy="person", cascade={"persist"})
     * @Api\Relation()
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $department;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Finance", mappedBy="majorInvestors")
     * @Api\Relation()
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $finances;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\Ico", mappedBy="team")
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\AnonymousAccess()
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
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
     * @param string|null $links
     *
     * @return Person
     */
    public function addLink($links = null)
    {
        $this->links[] = $links;

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
}
