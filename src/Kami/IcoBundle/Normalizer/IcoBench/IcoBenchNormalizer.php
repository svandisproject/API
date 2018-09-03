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
            'description' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\ScalarNormalizer',
                'property' => 'intro'
            ],
            'asset' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\AssetNormalizer',
                 'property' => 'finance.token'
            ],
            'country' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\CountryNormalizer',
                'property' => 'country'
            ],

            'finance' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\FinanceNormalizer',
                'property' => 'finance'
            ],
            'dates' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\DatesNormalizer',
                'property' => 'dates'
            ],
            'restrictedCountries' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\RestrictedCountriesNormalizer',
                'property' => 'restrictions'
            ],
            'team' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\TeamNormalizer',
                'property' => 'team'
            ],
            'industries' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\IndustryNormalizer',
                'property' => 'categories'
            ],
            'links' => [
                'normalizer' => 'Kami\IcoBundle\Normalizer\IcoBench\Property\ScalarNormalizer',
                'property' => 'links'
            ]
        ];
    }
}