<?php


namespace Kami\IcoBundle\Normalizer;

use Doctrine\ORM\EntityManager;
use Kami\IcoBundle\Entity\Ico;

class RestrictedCountriesNormalizer
{
    private $entityManager;

    public function __construct(EntityManager $manager)
    {
        $this->entityManager = $manager;
    }

    public function normalize($remoteRestrictedCountries, Ico $ico)
    {
        if(!empty($remoteRestrictedCountries)){
            foreach ($remoteRestrictedCountries as $item){
                $ico->addRestrictedCountry($item['country']);
            }
        }
    }

}