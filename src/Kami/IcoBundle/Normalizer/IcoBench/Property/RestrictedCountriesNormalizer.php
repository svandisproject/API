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
                    if($country = Country::getCodeFromName($item['country'], null))
                        array_push($restricted, $country);
                } catch (InvalidCountryName $exception) {}
            }
        }
        return $restricted;
    }
}