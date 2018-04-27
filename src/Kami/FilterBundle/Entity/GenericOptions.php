<?php


namespace Kami\FilterBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Kami\ApiCoreBundle\Annotation as Api;

class GenericOptions
{

    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=255)
     * @Assert\NotBlank()
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=255)
     * @Assert\NotBlank()
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255)
     * @Assert\NotBlank()
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\FilterBundle\Entity\FiltersSettings", inversedBy="assets")
     * @ORM\JoinColumn(name="filter_assets", referencedColumnName="id")
     */
    private $filterAssets;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\FilterBundle\Entity\FiltersSettings", inversedBy="region")
     * @ORM\JoinColumn(name="filter_region", referencedColumnName="id")
     */
    private $filterRegion;


    /**
     * Set id.
     *
     * @param string $id
     *
     * @return GenericOptions
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set label.
     *
     * @param string $label
     *
     * @return GenericOptions
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label.
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set value.
     *
     * @param string $value
     *
     * @return GenericOptions
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set filterAssets
     *
     * @param \Kami\FilterBundle\Entity\FilterSettings|null $filterAssets
     * @return GenericOptions
     */
    public function setFilterVoting(\Kami\FilterBundle\Entity\FilterSettings $filterAssets = null)
    {
        $this->filterAssets = $filterAssets;

        return $this;
    }

    /**
     * Get filterVoting
     *
     * @return \Kami\FilterBundle\Entity\FilterSettings|null
     */
    public function getFilterVoting()
    {
        return $this->filterAssets;
    }

    /**
     * Set filterRegion
     *
     * @param \Kami\FilterBundle\Entity\FilterSettings|null $filterRegion
     * @return GenericOptions
     */
    public function setFilterRegion(\Kami\FilterBundle\Entity\FilterSettings $filterRegion = null)
    {
        $this->filterRegion = $filterRegion;

        return $this;
    }

    /**
     * Get $filterRegion
     *
     * @return \Kami\FilterBundle\Entity\FilterSettings|null
     */
    public function getFilterRegion()
    {
        return $this->filterRegion;
    }

}