<?php

namespace Kami\IcoBundle\Normalizer\IcoBench;

use Kami\IcoBundle\Entity\Ico;
use Kami\IcoBundle\Normalizer\AbstractIcoNormalizer;

class RestrictedCountriesNormalizer extends AbstractIcoNormalizer
{

    /**
     * @param Ico $ico
     * @param $remoteData
     * @return Ico
     */
    public function normalize(Ico $ico, $remoteData): Ico
    {
       if (!empty($remoteData)) {
           foreach ($remoteData as $item) {
               $ico->addRestrictedCountry($item['country']);
           }
       }
       return $ico;
    }

    public function getNormalizingMap(): array
    {
        return [];
    }
}