<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use const false;
use Kami\ApiCoreBundle\Annotation as Api;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Legal
 *
 * @ORM\Table(name="legal")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\LegalRepository")
 * @Api\AnonymousAccess()
 * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
 * @Gedmo\Loggable
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
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $companyName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="company_url", type="string", length=255, nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $companyUrl;

    /**
     * @var string|null
     *
     * @ORM\Column(name="company_address", type="text", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $companyAddress;

    /**
     * @var array|null
     *
     * @ORM\Column(name="ofice_locations", type="array", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $oficeLocations;

    /**
     * @var bool
     *
     * @ORM\Column(name="team_kyc", type="boolean")
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $teamKYC =false;

    /**
     * @var array|null
     *
     * @ORM\Column(name="partnership", type="array", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $partnership;

    /**
     * @var bool
     *
     * @ORM\Column(name="buisness_model", type="boolean")
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $buisnessModel;

    /**
     * @var bool
     *
     * @ORM\Column(name="GDPR_compliant", type="boolean")
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $gDPRCompliant;

    /**
     * @ORM\OneToOne(targetEntity="Kami\IcoBundle\Entity\Ico", mappedBy="legal")
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\Relation()
     * @Gedmo\Versioned
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
     * Set companyUrl.
     *
     * @param string|null $companyUrl
     *
     * @return Legal
     */
    public function setCompanyUrl($companyUrl = null)
    {
        $this->companyUrl = $companyUrl;

        return $this;
    }

    /**
     * Get companyUrl.
     *
     * @return string|null
     */
    public function getCompanyUrl()
    {
        return $this->companyUrl;
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
     * Set oficeLocations.
     *
     * @param array|null $oficeLocations
     *
     * @return Legal
     */
    public function setOficeLocations($oficeLocations = null)
    {
        $this->oficeLocations = $oficeLocations;

        return $this;
    }

    /**
     * Get oficeLocations.
     *
     * @return array|null
     */
    public function getOficeLocations()
    {
        return $this->oficeLocations;
    }

    /**
     * Set teamKYC.
     *
     * @param bool $teamKYC
     *
     * @return Legal
     */
    public function setTeamKYC($teamKYC)
    {
        $this->teamKYC = $teamKYC;

        return $this;
    }

    /**
     * Get teamKYC.
     *
     * @return bool
     */
    public function getTeamKYC()
    {
        return $this->teamKYC;
    }

    /**
     * Set partnership.
     *
     * @param array|null $partnership
     *
     * @return Legal
     */
    public function setPartnership($partnership = null)
    {
        $this->partnership = $partnership;

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
     * Set buisnessModel.
     *
     * @param bool $buisnessModel
     *
     * @return Legal
     */
    public function setBuisnessModel($buisnessModel)
    {
        $this->buisnessModel = $buisnessModel;

        return $this;
    }

    /**
     * Get buisnessModel.
     *
     * @return bool
     */
    public function getBuisnessModel()
    {
        return $this->buisnessModel;
    }

    /**
     * Set gDPRCompliant.
     *
     * @param bool $gDPRCompliant
     *
     * @return Legal
     */
    public function setGDPRCompliant($gDPRCompliant)
    {
        $this->gDPRCompliant = $gDPRCompliant;

        return $this;
    }

    /**
     * Get gDPRCompliant.
     *
     * @return bool
     */
    public function getGDPRCompliant()
    {
        return $this->gDPRCompliant;
    }

    /**
     * @param Ico $ico
     * @return self
     */
    public function setIco(Ico $ico)
    {
        $this->ico = $ico;
        return $this;
    }

    /**
     * @return Ico
     */
    public function getIco()
    {
        return $this->ico;
    }
}
