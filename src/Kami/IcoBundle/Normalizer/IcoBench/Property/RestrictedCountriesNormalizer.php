<?php

namespace Kami\IcoBundle\Normalizer\IcoBench\Property;

use BrightNucleus\CountryCodes\Country;
use BrightNucleus\CountryCodes\Exception\InvalidCountryName;
use Kami\IcoBundle\Normalizer\AbstractPropertyNormalizer;

class RestrictedCountriesNormalizer extends AbstractPropertyNormalizer
{

    public function normalize($remoteData, $ico): array
    {
        $restricted = [];
        if (!empty($remoteData)) {

            foreach ($remoteData as $item) {
                try {
                    $restricted[] = Country::getCodeFromName($item['country'], '') ;
                } catch (InvalidCountryName $exception) {}
            }
        }
        return $restricted;
    }
}