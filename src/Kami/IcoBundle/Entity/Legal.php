<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use const false;

/**
 * Legal
 *
 * @ORM\Table(name="legal")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\LegalRepository")
 */
class Legal
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
     * @var string|null
     *
     * @ORM\Column(name="company_name", type="string", length=255, nullable=true)
     */
    private $companyName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="company_address", type="text", nullable=true)
     */
    private $companyAddress;

    /**
     * @var bool
     *
     * @ORM\Column(name="KYC_for_participant", type="boolean")
     */
    private $kYCForParticipant = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="business_model", type="boolean")
     */
    private $businessModel;

    /**
     * @var bool
     *
     * @ORM\Column(name="GDPR", type="boolean")
     */
    private $gDPR;

    /**
     * @var array|null
     *
     * @ORM\Column(name="partnership", type="array", nullable=true)
     */
    private $partnership;

    /**
     * @ORM\OneToOne(targetEntity="Kami\IcoBundle\Entity\Ico", inversedBy="legal")
     */
    private $ico;


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
     * Set companyName.
     *
     * @param string|null $companyName
     *
     * @return Legal
     */
    public function setCompanyName($companyName = null)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName.
     *
     * @return string|null
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set companyAddress.
     *
     * @param string|null $companyAddress
     *
     * @return Legal
     */
    public function setCompanyAddress($companyAddress = null)
    {
        $this->companyAddress = $companyAddress;

        return $this;
    }

    /**
     * Get companyAddress.
     *
     * @return string|null
     */
    public function getCompanyAddress()
    {
        return $this->companyAddress;
    }

    /**
     * Set kYCForParticipant.
     *
     * @param bool $kYCForParticipant
     *
     * @return Legal
     */
    public function setKYCForParticipant($kYCForParticipant)
    {
        $this->kYCForParticipant = $kYCForParticipant;

        return $this;
    }

    /**
     * Get kYCForParticipant.
     *
     * @return bool
     */
    public function getKYCForParticipant()
    {
        return $this->kYCForParticipant;
    }

    /**
     * Set businessModel.
     *
     * @param bool $businessModel
     *
     * @return Legal
     */
    public function setBusinessModel($businessModel)
    {
        $this->businessModel = $businessModel;

        return $this;
    }

    /**
     * Get businessModel.
     *
     * @return bool
     */
    public function getBusinessModel()
    {
        return $this->businessModel;
    }

    /**
     * Set gDPR.
     *
     * @param bool $gDPR
     *
     * @return Legal
     */
    public function setGDPR($gDPR)
    {
        $this->gDPR = $gDPR;

        return $this;
    }

    /**
     * Get gDPR.
     *
     * @return bool
     */
    public function getGDPR()
    {
        return $this->gDPR;
    }

    /**
     * Set partnership.
     *
     * @param string|null $partnership
     *
     * @return Legal
     */
    public function setPartnership($partnership = null)
    {
        if ($partnership) {
            $this->partnership[] = $partnership;
        }

        return $this;
    }

    /**
     * Get partnership.
     *
     * @return array|null
     */
    public function getPartnership()
    {
        return $this->partnership;
    }

    /**
     * @param Ico $ico
     *
     * @return self
     */
    public function setIco($ico): self
    {
        $this->ico = $ico;

        return $this;
    }

    /**
     * @return Ico
     */
    public function getIco(): Ico
    {
        return $this->ico;
    }

}
