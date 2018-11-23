<?php

namespace Kami\WorkerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kami\ApiCoreBundle\Annotation as Api;

/**
 * Stat
 *
 * @ORM\Table(name="stat")
 * @ORM\Entity()
 * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_USER"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_USER"})
 * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
 */
class Stat
{
    /**
     * @var int
     *
     * @Api\Access({"ROLE_ADMIN"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="total_amount", type="integer")
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $totalAmount;

    /**
     * @var float
     *
     * @ORM\Column(name="toxicity", type="decimal", precision=5, scale=2)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $toxicity;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="listed", type="datetime")
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $listed;

    /**
     * @var float
     *
     * @ORM\Column(name="frequency", type="decimal", precision=5, scale=2)
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $frequency;

    /**
     * @ORM\OneToOne(targetEntity="Kami\WorkerBundle\Entity\WebFeed", inversedBy="stat")
     * @Api\Relation()
     * @Api\Access({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN", "ROLE_USER"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     */
    private $webFeed;

    /**
     * @return WebFeed|null
     */
    public function getWebFeed(): ?WebFeed
    {
        return $this->webFeed;
    }

    /**
     * @param WebFeed $webFeed
     *
     * @return self
     */
    public function setWebFeed($webFeed): self
    {
        $this->webFeed = $webFeed;
        return $this;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * Set totalAmount.
     *
     * @param integer $totalAmount
     *
     * @return Stat
     */
    public function setTotalAmount(int $totalAmount) : Stat
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    /**
     * Get totalAmount.
     *
     * @return int
     */
    public function getTotalAmount() : ?int
    {
        return $this->totalAmount;
    }

    /**
     * Set toxicity.
     *
     * @param float $toxicity
     *
     * @return Stat
     */
    public function setToxicity($toxicity) : Stat
    {
        $this->toxicity = $toxicity;

        return $this;
    }

    /**
     * Get toxicity.
     *
     * @return float
     */
    public function getToxicity() : ?float
    {
        return $this->toxicity;
    }

    /**
     * Set listed.
     *
     * @param \DateTime $listed
     *
     * @return Stat
     */
    public function setListed($listed) : Stat
    {
        $this->listed = $listed;

        return $this;
    }

    /**
     * Get listed.
     *
     * @return \DateTime
     */
    public function getListed() : ?\DateTime
    {
        return $this->listed;
    }

    /**
     * @return float
     */
    public function getFrequency(): ?float
    {
        return $this->frequency;
    }

    /**
     * @param float $frequency
     * @return Stat
     */
    public function setFrequency(float $frequency): Stat
    {
        $this->frequency = $frequency;

        return $this;
    }


}
