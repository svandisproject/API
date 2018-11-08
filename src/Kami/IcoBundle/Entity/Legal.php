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
 * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
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
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
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
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
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
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $companyAddress;

    /**
     * @var array|null
     *
     * @ORM\Column(name="office_locations", type="array", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $officeLocations;

    /**
     * @var bool
     *
     * @ORM\Column(name="team_kyc", type="boolean", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $teamKyc =false;

    /**
     * @var array|null
     *
     * @ORM\Column(name="partnership", type="array", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $partnership;

    /**
     * @var bool
     *
     * @ORM\Column(name="buisness_model", type="boolean", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $buisnessModel;

    /**
     * @var bool
     *
     * @ORM\Column(name="GDPR_compliant", type="boolean", nullable=true)
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $gDprCompliant = false;

    /**
     * @ORM\OneToOne(targetEntity="Kami\IcoBundle\Entity\Ico", mappedBy="legal")
     * @Api\AnonymousAccess()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
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
     * Set officeLocations.
     *
     * @param array|null $officeLocations
     *
     * @return Legal
     */
    public function setOfficeLocations($officeLocations = null)
    {
        $this->officeLocations = $officeLocations;

        return $this;
    }

    /**
     * Get officeLocations.
     *
     * @return array|null
     */
    public function getOfficeLocations()
    {
        return $this->officeLocations;
    }

    /**
     * Set teamKyc.
     *
     * @param bool $teamKyc
     *
     * @return Legal
     */
    public function setTeamKyc($teamKyc)
    {
        $this->teamKyc = $teamKyc;

        return $this;
    }

    /**
     * Get teamKyc.
     *
     * @return bool
     */
    public function getTeamKyc()
    {
        return $this->teamKyc;
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
     * Set gDprCompliant.
     *
     * @param bool $gDprCompliant
     *
     * @return Legal
     */
    public function setGDprCompliant($gDprCompliant)
    {
        $this->gDprCompliant = $gDprCompliant;

        return $this;
    }

    /**
     * Get gDprCompliant.
     *
     * @return bool
     */
    public function getGDprCompliant()
    {
        return $this->gDprCompliant;
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
