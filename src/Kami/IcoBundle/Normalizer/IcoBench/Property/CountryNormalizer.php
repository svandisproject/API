<?php


namespace Kami\IcoBundle\Normalizer\IcoBench\Property;

use BrightNucleus\CountryCodes\Country;
use BrightNucleus\CountryCodes\Exception\InvalidCountryName;
use Kami\IcoBundle\Normalizer\AbstractPropertyNormalizer;

class CountryNormalizer extends AbstractPropertyNormalizer
{
    /**
     * @param $remoteData
     * @return string
     */
    public function normalize($remoteData, $ico): ?string
    {
        try {
            return Country::getCodeFromName($remoteData, '');
        } catch (InvalidCountryName $exception) {
            return null;
        }
    }
}
