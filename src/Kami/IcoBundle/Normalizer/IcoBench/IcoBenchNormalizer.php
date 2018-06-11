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
            'title' => '',
            'asset' => '',
            'country' => '',
            'restrictedCountries' => '',
            'openPresale' => '',
            'kyc' => '',
            'hardCap' => '',
            'totalCap' => '',
            'raised' => '',
            'tokenPrice' => '',
            'forSale' => '',
            'tokenSaleDate' => '',
            'team' => '',
            'advisors' => '',
            'partners' => '',
            'competitors' => '',
        ];
    }
}