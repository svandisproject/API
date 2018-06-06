<?php


namespace Kami\IcoBundle\Normalizer\IcoBench;
use Kami\IcoBundle\Normalizer\AbstractIcoNormalizer;
use Kami\IcoBundle\Entity\Ico;

class RestrictedCountriesNormalizer extends AbstractIcoNormalizer
{
    public function fromRemote(Ico $ico, $remoteData)
    {
        foreach ($remoteData as $item){
            $ico->addRestrictedCountry($item['country']);
        }
    }

    public function getPropertyMap(): array
    {
        return [];
    }


}