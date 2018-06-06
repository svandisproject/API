<?php


namespace Kami\IcoBundle\Normalizer\IcoBench;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Kami\IcoBundle\Normalizer\AbstractIcoNormalizer;

class IcoBenchNormalizer extends AbstractIcoNormalizer
{
    /**
     * @var ArrayCollection
     */
    protected $normalizers;

    public function __construct(EntityManager $manager, array $normalizers)
    {
        $this->normalizers = new ArrayCollection();
        foreach ($normalizers as $normalizer) {
            $this->normalizers->set(get_class($normalizer), $normalizer);
        }

        parent::__construct($manager);
    }

    public function getPropertyMap() : array
    {
        return [
            'rating' => 'rating',
            'icoToken' => 'finance.token',
            'ratingTeam' => 'ratingTeam',
            'ratingProfile' => 'ratingProfile',
            'ratingVision' => 'ratingVision',
            'ratingProduct' => 'ratingProduct',
            'remoteId' => 'id',
            'country' => 'country',
            'icoUrl' => 'url',
            'icoTagline' => 'tagline',
            'icoIntro' => 'intro',
            'icoAbout' => 'about',
            'platform' => 'finance.platform',
            'icoTokenPrice' => 'finance.price',
            'hardCap' => 'finance.hardcap',
            'minCap' => 'finance.softcap',
            'raised' => 'finance.raised',
            'bonus' => 'finance.bonus',
            'openPresale' => 'dates.preIcoStart',

            'teamMember' => [
                'property' => 'team',
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\TeamMembersNormalizer'
            ],

            'tokenType' => [
                'property' => 'finance.tokentype',
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\TokenTypeNormalizer'
            ],

            'kyc' => [
                'property' => 'kyc',
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\KycNormalizer',
                'method' => 'addKyc'
            ],
            'industries' => [
                'property'=>'categories',
                'normalizer'=>'Kami\IcoBundle\Normalizer\IcoBench\IndustryNormalizer',
                'method' => 'addIndustry'
            ],
            'acceptingAssets' => [
                'property' => 'finance.accepting',
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\AcceptingAssetsNormalizer'
            ],
            'restrictedCountries' => [
                'property'=>'restrictions',
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\RestrictedCountriesNormalizer'
            ],
        ];
    }
}