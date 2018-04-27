<?php


namespace Kami\FilterBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use const null;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Kami\ApiCoreBundle\Annotation as Api;

class GenericCheckbox
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
     * @var bool
     *
     * @ORM\Column(name="checked", type="boolean")
     */
    private $checked;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\FilterBundle\Entity\FiltersSettings", inversedBy="activityFields")
     * @ORM\JoinColumn(name="filter_fields", referencedColumnName="id")
     */
    private $filterFields;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\FilterBundle\Entity\FiltersSettings", inversedBy="importanceFilters")
     * @ORM\JoinColumn(name="filter_importance", referencedColumnName="id")
     */
    private $filterImportance;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\FilterBundle\Entity\FiltersSettings", inversedBy="votingFilters")
     * @ORM\JoinColumn(name="filter_voting", referencedColumnName="id")
     */
    private $filterVoting;

    /**
     * Set id
     *
     * @param string $id
     *
     * @return GenericCheckbox
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set label
     *
     * @param string $label
     *
     * @return GenericCheckbox
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set checked
     *
     * @param boolean $checked
     *
     * @return GenericCheckbox
     */
    public function setChecked($checked)
    {
        $this->checked = $checked;

        return $this;
    }

    /**
     * Get checked
     *
     * @return boolean
     */
    public function getChecked()
    {
        return $this->checked;
    }

    /**
     * Set filterFields
     *
     * @param \Kami\FilterBundle\Entity\FilterSettings|null $filterFields
     * @return GenericCheckbox
     */
    public function setFilterFields(\Kami\FilterBundle\Entity\FilterSettings $filterFields = null)
    {
        $this->filterFields = $filterFields;

        return $this;
    }

    /**
     * Get filterFields
     *
     * @return \Kami\FilterBundle\Entity\FilterSettings|null
     */
    public function getFilterFields()
    {
        return $this->filterFields;
    }


    /**
 * Set filterImportance
 *
 * @param \Kami\FilterBundle\Entity\FilterSettings|null $filterImportance
 * @return GenericCheckbox
 */
    public function setFilterImportance(\Kami\FilterBundle\Entity\FilterSettings $filterImportance = null)
    {
        $this->filterImportance = $filterImportance;

        return $this;
    }

    /**
     * Get filterImportance
     *
     * @return \Kami\FilterBundle\Entity\FilterSettings|null
     */
    public function getFilterImportance()
    {
        return $this->filterImportance;
    }


    /**
     * Set filterVoting
     *
     * @param \Kami\FilterBundle\Entity\FilterSettings|null $filterVoting
     * @return GenericCheckbox
     */
    public function setFilterVoting(\Kami\FilterBundle\Entity\FilterSettings $filterVoting = null)
    {
        $this->filterVoting = $filterVoting;

        return $this;
    }

    /**
     * Get filterVoting
     *
     * @return \Kami\FilterBundle\Entity\FilterSettings|null
     */
    public function getFilterVoting()
    {
        return $this->filterVoting;
    }


}