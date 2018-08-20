<?php

namespace Kami\IcoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use const false;
use Kami\AssetBundle\Entity\Asset;

/**
 * Development
 *
 * @ORM\Table(name="development")
 * @ORM\Entity(repositoryClass="Kami\IcoBundle\Repository\DevelopmentRepository")
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
     * @ORM\Column(name="native_blockchain", type="boolean")
     */
    private $nativeBlockchain = false;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lightpaper_link", type="string", length=255, nullable=true)
     */
    private $lightpaperLink;

    /**
     * @var string|null
     *
     * @ORM\Column(name="whitepaper_link", type="string", length=255, nullable=true)
     */
    private $whitepaperLink;

    /**
     * @var string
     *
     * @ORM\Column(name="type_of_consensus", type="string", length=100)
     */
    private $typeOfConsensus;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\IcoBundle\Entity\DevelopmentStage", inversedBy="developments")
     */
    private $development_stage;

    /**
     * @var bool
     *
     * @ORM\Column(name="open_source", type="boolean")
     */
    private $openSource = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="demo_availability", type="boolean")
     */
    private $demoAvailability = false;

    /**
     * @var string|null
     *
     * @ORM\Column(name="github_link", type="string", length=255, nullable=true)
     */
    private $githubLink;

    /**
     * @ORM\OneToOne(targetEntity="Kami\IcoBundle\Entity\Ico", inversedBy="development")
     */
    private $ico;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\AssetBundle\Entity\Asset")
     * @ORM\JoinColumn(name="asset_id", referencedColumnName="id")
     */
    private $token_for_crowdfunding;

    /**
     * @ORM\Column(type="boolean")
     */
    private $smart_contract_audit = false;

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
     * Set lightpaperLink.
     *
     * @param string|null $lightpaperLink
     *
     * @return Development
     */
    public function setLightpaperLink($lightpaperLink = null)
    {
        $this->lightpaperLink = $lightpaperLink;

        return $this;
    }

    /**
     * Get lightpaperLink.
     *
     * @return string|null
     */
    public function getLightpaperLink()
    {
        return $this->lightpaperLink;
    }

    /**
     * Set whitepaperLink.
     *
     * @param string|null $whitepaperLink
     *
     * @return Development
     */
    public function setWhitepaperLink($whitepaperLink = null)
    {
        $this->whitepaperLink = $whitepaperLink;

        return $this;
    }

    /**
     * Get whitepaperLink.
     *
     * @return string|null
     */
    public function getWhitepaperLink()
    {
        return $this->whitepaperLink;
    }

    /**
     * Set typeOfConsensus.
     *
     * @param string $typeOfConsensus
     *
     * @return Development
     */
    public function setTypeOfConsensus($typeOfConsensus)
    {
        $this->typeOfConsensus = $typeOfConsensus;

        return $this;
    }

    /**
     * Get typeOfConsensus.
     *
     * @return string
     */
    public function getTypeOfConsensus()
    {
        return $this->typeOfConsensus;
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
     * @return Ico
     */
    public function getIco(): Ico
    {
        return $this->ico;
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
     * @return Asset
     */
    public function getTokenForCrowdfunding()
    {
        return $this->token_for_crowdfunding;
    }

    /**
     * @param Asset $token_for_crowdfunding
     *
     * @return self
     */
    public function setTokenForCrowdfunding($token_for_crowdfunding): self
    {
        $this->token_for_crowdfunding = $token_for_crowdfunding;
        return $this;
    }

    /**
     * @return DevelopmentStage
     */
    public function getDevelopmentStage()
    {
        return $this->development_stage;
    }

    /**
     * @param DevelopmentStage $development_stage
     *
     * @return self
     */
    public function setDevelopmentStage($development_stage)
    {
        $this->development_stage = $development_stage;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getSmartContractAudit()
    {
        return $this->smart_contract_audit;
    }

    /**
     * @param boolean $smart_contract_audit
     */
    public function setSmartContractAudit($smart_contract_audit)
    {
        $this->smart_contract_audit = $smart_contract_audit;
    }
}
