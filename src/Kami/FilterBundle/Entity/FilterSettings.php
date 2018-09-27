<?php


namespace Kami\FilterBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Kami\ApiCoreBundle\Annotation as Api;


class FilterSettings
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
     * @ORM\Column(name="search_query", type="string", length=255)
     */
    private $searchQuery;

    /**
     * @ORM\OneToMany(targetEntity="App\FilterBundle\Entity\FilterItem", mappedBy="id")
     * @Api\Relation()
     */
    private $assets;

    /**
     * @ORM\OneToMany(targetEntity="App\FilterBundle\Entity\FilterItem", mappedBy="id")
     * @Api\Relation()
     */
    private $region;

    /**
     * @ORM\OneToMany(targetEntity="App\FilterBundle\Entity\FilterItem", mappedBy="id")
     * @Api\Relation()
     */
   private $activityFields;

    /**
     * @ORM\OneToMany(targetEntity="App\FilterBundle\Entity\FilterItem", mappedBy="id"))
     * @Api\Relation()
     */
    private $importanceFilters;

    /**
     * @ORM\OneToMany(targetEntity="App\FilterBundle\Entity\FilterItem", mappedBy="id")
     * @Api\Relation()
     */
    private $votingFilters;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\UserBundle\Entity\User", inversedBy="filterSettings")
     * @Api\Relation()
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


    public function __construct()
    {
        $this->assets = new ArrayCollection();
        $this->region = new ArrayCollection();
        $this->activityFields = new ArrayCollection();
        $this->importanceFilters = new ArrayCollection();
        $this->votingFilters = new ArrayCollection();

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
     * Set searchQuery.
     *
     * @param string $searchQuery
     *
     * @return FilterSettings
     */
    public function setSearchQuery($searchQuery)
    {
        $this->searchQuery = $searchQuery;

        return $this;
    }

    /**
     * Get searchQuery.
     *
     * @return string
     */
    public function getSearchQuery()
    {
        return $this->searchQuery;
    }

    /**
     * @return ArrayCollection|FilterItem[]
     */

    public function getAssets()
    {
        return $this->assets;
    }

    /**
     * @return ArrayCollection|FilterItem[]
     */

    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @return ArrayCollection|FilterItem[]
     */

    public function getActivityFields()
    {
        return $this->activityFields;
    }

    /**
     * @return ArrayCollection|FilterItem[]
     */

    public function getImportanceFilters()
    {
        return $this->importanceFilters;
    }

    /**
     * @return ArrayCollection|FilterItem[]
     */

    public function getVotingFilters ()
    {
        return $this->votingFilters;
    }

    /**
     * Get user.
     *
     * @return \Kami\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

}