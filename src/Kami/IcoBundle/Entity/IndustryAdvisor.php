<?php


namespace Kami\IcoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * IndustryAdvisor
 *
 * @ORM\Table(name="industry_advisor")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\IndustryAdvisorRepository")
 */
class IndustryAdvisor
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
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\IcoBundle\Entity\IcoScreener", mappedBy="industryAdvisors")
     */
    private $icoScreeners;

    public function __construct() {
        $this->icoScreeners = new ArrayCollection();
    }

    /**
    * Add icoScreener.
    *
    * @param IcoScreener $icoScreener
    */
    public function addIcoScreener(IcoScreener $icoScreener)
    {
        $icoScreener->addIndustryAdvisor($this);
        $this->icoScreeners[] = $icoScreener;
    }

    /**
     * Remove icoScreener.
     *
     * @param IcoScreener $icoScreener
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeIcoScreener(IcoScreener $icoScreener)
    {
        return $this->icoScreeners->removeElement($icoScreener);
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
     * Set name.
     *
     * @param string $name
     *
     * @return IndustryAdvisor
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
}