<?php


namespace Kami\AssetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kami\ApiCoreBundle\Annotation as Api;


/**
 * Volume
 *
 * @ORM\Entity(repositoryClass="Kami\AssetBundle\Repository\VolumeRepository")
 * @ORM\Table(name="volume")
 * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
 * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
 */
class Volume
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\AssetBundle\Entity\Asset", inversedBy="volumes")
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $asset;

    /**
     * @ORM\Column(name="volume_usd", type="decimal", precision=25, scale=15)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $volumeUsd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="added_time", type="datetime")
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_WORKER", "ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     */
    private $addedTime;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Asset
     */
    public function getAsset() :Asset
    {
        return $this->asset;
    }

    /**
     * @param Asset $asset
     *
     * @return Volume
     */
    public function setAsset(Asset $asset) :Volume
    {
        $this->asset = $asset;

        return $this;
    }

    /**
     * @return integer
     */
    public function getVolumeUsd()
    {
        return $this->volumeUsd;
    }

    /**
     * @param integer $volumeUsd
     *
     * @return Volume
     */
    public function setVolumeUsd($volumeUsd)
    {
        $this->volumeUsd = $volumeUsd;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getAddedTime(): \DateTime
    {
        return $this->addedTime;
    }

    /**
     * @param \DateTime $addedTime
     *
     * @return Volume
     */
    public function setAddedTime(\DateTime $addedTime)
    {
        $this->addedTime = $addedTime;
        return $this;
    }

}