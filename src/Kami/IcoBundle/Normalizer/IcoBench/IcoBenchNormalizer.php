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

    public function getNormalizingMap() : array
    {
        return [
            'remoteId' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\ScalarNormalizer',
                'property' => 'id'
            ],
            'title' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\ScalarNormalizer',
                'property' => 'name'
            ],
            'asset' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\AssetNormalizer',
                 'property' => 'finance.token'
            ],
            'country' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\CountryNormalizer',
                'property' => 'country'
            ],
            'restrictedCountries' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\RestrictedCountriesNormalizer',
                'property' => 'restrictions'
            ],
            'openPresale' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\DateTimeNormalizer',
                'property' => 'dates.preIcoStart'
            ],
            'kyc' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\KycNormalizer',
                'property' => 'kyc'
            ],
            'hardCap' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\ScalarNormalizer',
                'property' => 'finance.hardcap'
            ],
            'raised' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\ScalarNormalizer',
                'property' => 'finance.raised'
            ],
            'tokenPrice' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\UsdPriceNormalizer',
                'property' => 'finance'
            ],
            'tokenSaleDate' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\DateTimeNormalizer',
                'property' => 'dates.icoStart'
            ],
            'team' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\TeamNormalizer',
                'property' => 'team'
            ],
            'advisors' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\AdvisorsNormalizer',
                'property' => 'ratings'
            ],
            'industries' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\IndustryNormalizer',
                'property' => 'categories'
            ]
        ];
    }
}