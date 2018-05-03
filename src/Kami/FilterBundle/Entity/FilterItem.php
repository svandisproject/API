<?php


namespace Kami\FilterBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use const null;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Kami\ApiCoreBundle\Annotation as Api;

class FilterItem
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
     * @ORM\Column(name="value", type="string", length=255)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     */
    private $value = null;

    /**
     * @var bool
     *
     * @ORM\Column(name="selected", type="boolean")
     */
    private $selected;


    /**
     * Set id
     *
     * @param string $id
     *
     * @return FilterItem
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
     * @return FilterItem
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
     * Set value
     *
     * @param string $value
     *
     * @return FilterItem
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set selected
     *
     * @param boolean $selected
     *
     * @return FilterItem
     */
    public function setSelected($selected)
    {
        $this->selected = $selected;

        return $this;
    }

    /**
     * Get selected
     *
     * @return boolean
     */
    public function getSelected()
    {
        return $this->selected;
    }


}