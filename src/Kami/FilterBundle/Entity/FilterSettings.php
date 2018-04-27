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
     *  @ORM\Column(name="search_query", type="string", length=255)
     */
    private $searchQuery;

    /**
     *@ORM\OneToMany(targetEntity="App\FilterBundle\Entity\GenericOptions", mappedBy="filterAssets")
     */
    private $assets;

    /**
     *@ORM\OneToMany(targetEntity="App\FilterBundle\Entity\GenericOptions", mappedBy="filterRegion")
     */
    private $region;

    /**
     *@ORM\OneToMany(targetEntity="App\FilterBundle\Entity\GenericCheckbox", mappedBy="filterFields")
     */
   private $activityFields;

    /**
     *@ORM\OneToMany(targetEntity="App\FilterBundle\Entity\GenericCheckbox", mappedBy="filterImportance")
     */
    private $importanceFilters;

    /**
     *@ORM\OneToMany(targetEntity="App\FilterBundle\Entity\GenericCheckbox", mappedBy="filterVoting")
     */
    private $votingFilters;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\UserBundle\Entity\User", inversedBy="workers")
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
    public function getSecret()
    {
        return $this->searchQuery;
    }

    /**
     * @return ArrayCollection|GenericOptions[]
     */

    public function getAssets()
    {
        return $this->assets;
    }

    /**
     * @return ArrayCollection|GenericOptions[]
     */

    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @return ArrayCollection|GenericCheckbox[]
     */

    public function getActivityFields()
    {
        return $this->activityFields;
    }

    /**
     * @return ArrayCollection|GenericCheckbox[]
     */

    public function getImportanceFilters()
    {
        return $this->importanceFilters;
    }

    /**
     * @return ArrayCollection|GenericCheckbox[]
     */

    public function getVotingFilters ()
    {
        return $this->votingFilters;
    }


}