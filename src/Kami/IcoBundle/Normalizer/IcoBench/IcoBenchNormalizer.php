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
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\AssetNormalizer',
                 'property' => 'finance.token'
            ],
            'country' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\ScalarNormalizer',
                'property' => 'country'
            ],
            'restrictedCountries' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\RestrictedCountriesNormalizer',
                'property' => 'restrictions'
            ],
            'openPresale' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\ScalarNormalizer',
                'property' => 'dates.preIcoStart'
            ],
            'kyc' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\KycNormalizer',
                'property' => 'kyc'
            ],
            'hardCap' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\ScalarNormalizer',
                'property' => 'finance.hardcap'
            ],
//            'totalCap' => '',
            'raised' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\ScalarNormalizer',
                'property' => 'finance.raised'
            ],
            'tokenPrice' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\ScalarNormalizer',
                'property' => 'finance.price'
            ],
//            'forSale' => '',
            'tokenSaleDate' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\ScalarNormalizer',
                'property' => 'dates.icoStart'
            ],
            'team' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\TeamNormalizer',
                'property' => 'team'
            ],
            'advisors' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\AdvisorsNormalizer',
                'property' => 'ratings'
            ],
//            'partners' => '',
//            'competitors' => '',
            'industry' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\IndustryNormalizer',
                'property' => 'categories'
            ]
        ];
    }
}