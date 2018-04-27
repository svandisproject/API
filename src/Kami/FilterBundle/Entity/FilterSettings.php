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
     *  @ORM\Column(name="searchQuery", type="string", length=255)
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


    public function __construct()
    {
        $this->assets = new ArrayCollection();
        $this->region = new ArrayCollection();
        $this->activityFields = new ArrayCollection();
        $this->importanceFilters = new ArrayCollection();
        $this->votingFilters = new ArrayCollection();

    }


}