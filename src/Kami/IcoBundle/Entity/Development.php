<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Kami\ApiCoreBundle\Annotation as Api;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Development
 *
 * @ORM\Table(name="development")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\DevelopmentRepository")
 * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
 * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
 * @Gedmo\Loggable
 */
class Development
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
     * @var bool
     *
     * @ORM\Column(name="native_blockchain", type="boolean", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $nativeBlockchain = false;

    /**
     * @var string
     *
     * @ORM\Column(name="whitepaper_link", type="string", length=255, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $whitepaperLink;

    /**
     * @var bool
     *
     * @ORM\Column(name="open_source", type="boolean", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $openSource = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="demo_availability", type="boolean", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $demoAvailability = false;

    /**
     * @var string|null
     *
     * @ORM\Column(name="demo_link", type="string", length=255, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $demoLink;

    /**
     * @var string|null
     * @ORM\Column(name="github_link", type="string", length=255, nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $githubLink;

    /**
     * @var bool
     *
     * @ORM\Column(name="smart_contract_audit", type="boolean", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $smartContractAudit = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="code_audits", type="boolean", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $codeAudits = false;

    /**
     * @var array
     *
     * @ORM\Column(name="wallet_audit", type="array", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $walletAudit;

    /**
     * @ORM\Column(name="testnet_date", type="datetime", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Api\Form(type="Symfony\Component\Form\Extension\Core\Type\DateTimeType",
     *     options={"widget": "single_text"})
     * @Gedmo\Versioned
     */
    private $testnetDate;

    /**
     * @ORM\Column(name="mainnet_date", type="datetime", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Api\Form(type="Symfony\Component\Form\Extension\Core\Type\DateTimeType",
     *     options={"widget": "single_text"})
     * @Gedmo\Versioned
     */
    private $mainnetDate;

    /**
     * @var int|null
     *
     * @ORM\Column(name="projectCompletion", type="integer", nullable=true)
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $projectCompletion;

    /**
     * @ORM\OneToMany(targetEntity="Kami\IcoBundle\Entity\DevStages", mappedBy="development")
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $stages;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\IcoBundle\Entity\ConsensusType", inversedBy="development", cascade={"persist"})
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $consensusType;

    /**
     * @ORM\OneToOne(targetEntity="Kami\IcoBundle\Entity\Ico", mappedBy="development")
     * @Api\Relation()
     * @Api\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeUpdatedBy({"ROLE_ADMIN"})
     * @Api\CanBeDeletedBy({"ROLE_ADMIN"})
     * @Gedmo\Versioned
     */
    private $ico;

    public function __construct() {
        $this->stages = new ArrayCollection();
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
     * Set nativeBlockchain.
     *
     * @param bool $nativeBlockchain
     *
     * @return Development
     */
    public function setNativeBlockchain($nativeBlockchain)
    {
        $this->nativeBlockchain = $nativeBlockchain;

        return $this;
    }

    /**
     * Get nativeBlockchain.
     *
     * @return bool
     */
    public function getNativeBlockchain()
    {
        return $this->nativeBlockchain;
    }

    /**
     * Set whitepaperLink.
     *
     * @param string $whitepaperLink
     *
     * @return Development
     */
    public function setWhitepaperLink($whitepaperLink)
    {
        $this->whitepaperLink = $whitepaperLink;

        return $this;
    }

    /**
     * Get whitepaperLink.
     *
     * @return string
     */
    public function getWhitepaperLink()
    {
        return $this->whitepaperLink;
    }

    /**
     * Set openSource.
     *
     * @param bool $openSource
     *
     * @return Development
     */
    public function setOpenSource($openSource)
    {
        $this->openSource = $openSource;

        return $this;
    }

    /**
     * Get openSource.
     *
     * @return bool
     */
    public function getOpenSource()
    {
        return $this->openSource;
    }

    /**
     * Set demoAvailability.
     *
     * @param bool $demoAvailability
     *
     * @return Development
     */
    public function setDemoAvailability($demoAvailability)
    {
        $this->demoAvailability = $demoAvailability;

        return $this;
    }

    /**
     * Get demoAvailability.
     *
     * @return bool
     */
    public function getDemoAvailability()
    {
        return $this->demoAvailability;
    }

    /**
     * Set demoLink.
     *
     * @param string|null $demoLink
     *
     * @return Development
     */
    public function setDemoLink($demoLink = null)
    {
        $this->demoLink = $demoLink;

        return $this;
    }

    /**
     * Get demoLink.
     *
     * @return string|null
     */
    public function getDemoLink()
    {
        return $this->demoLink;
    }

    /**
     * Set githubLink.
     *
     * @param string|null $githubLink
     *
     * @return Development
     */
    public function setGithubLink($githubLink = null)
    {
        $this->githubLink = $githubLink;

        return $this;
    }

    /**
     * Get githubLink.
     *
     * @return string|null
     */
    public function getGithubLink()
    {
        return $this->githubLink;
    }

    /**
     * Set smartContractAudit.
     *
     * @param bool $smartContractAudit
     *
     * @return Development
     */
    public function setSmartContractAudit($smartContractAudit)
    {
        $this->smartContractAudit = $smartContractAudit;

        return $this;
    }

    /**
     * Get smartContractAudit.
     *
     * @return bool
     */
    public function getSmartContractAudit()
    {
        return $this->smartContractAudit;
    }

    /**
     * Set codeAudits.
     *
     * @param bool $codeAudits
     *
     * @return Development
     */
    public function setCodeAudits($codeAudits)
    {
        $this->codeAudits = $codeAudits;

        return $this;
    }

    /**
     * Get codeAudits.
     *
     * @return bool
     */
    public function getCodeAudits()
    {
        return $this->codeAudits;
    }

    /**
     * Add walletAudit.
     *
     * @param string $walletAudit
     *
     * @return Development
     */
    public function addWalletAudit($walletAudit)
    {
        $this->walletAudit[] = $walletAudit;

        return $this;
    }

    /**
     * Get walletAudit.
     *
     * @return array
     */
    public function getWalletAudit()
    {
        return $this->walletAudit;
    }

    /**
     * Set projectCompletion.
     *
     * @param int|null $projectCompletion
     *
     * @return Development
     */
    public function setProjectCompletion($projectCompletion = null)
    {
        $this->projectCompletion = $projectCompletion;

        return $this;
    }

    /**
     * Get projectCompletion.
     *
     * @return int|null
     */
    public function getProjectCompletion()
    {
        return $this->projectCompletion;
    }

    /**
     * @return ArrayCollection
     */
    public function getStages()
    {
        return $this->stages;
    }

    /**
     * @param $stages
     * @return self
     */
    public function setStages($stages)
    {
        $this->stages = $stages;
        return $this;
    }

    public function addStage(DevStages $stage)
    {
        if (!$this->stages->contains($stage)) {
            $this->stages[] = $stage;
        }
        return $this;
    }


    /**
     * @return ConsensusType
     */
    public function getConsensusType()
    {
        return $this->consensusType;
    }

    /**
     * @param ConsensusType $consensusType
     * @return self
     */
    public function setConsensusType($consensusType)
    {
        $this->consensusType = $consensusType;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getMainnetDate()
    {
        return $this->mainnetDate;
    }

    /**
     * @param \DateTime $mainnetDate
     * @return self
     */
    public function setMainnetDate($mainnetDate)
    {
        $this->mainnetDate = $mainnetDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTestnetDate()
    {
        return $this->testnetDate;
    }

    /**
     * @param \DateTime $testnetDate
     * @return self
     */
    public function setTestnetDate($testnetDate)
    {
        $this->testnetDate = $testnetDate;
        return $this;
    }

    /**
     * @param Ico $ico
     * @return self
     */
    public function setIco($ico)
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
