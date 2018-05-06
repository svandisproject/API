<?php


namespace Kami\IcoBundle\Normalizer;

class IcoBench extends AbstractIcoNormalizer
{
    public function getPropertyMap()
    {
        return [
            'rating' => 'rating',
            'icoToken' => 'finance.token',
            'ratingTeam' => 'ratingTeam',
            'ratingProfile' => 'ratingProfile',
            'ratingVision' => 'ratingVision',
            'ratingProduct' => 'ratingProduct',
            'remoteId' => 'id',
            'country' => 'country',
            'icoUrl' => 'url',
            'icoTagline' => 'tagline',
            'icoIntro' => 'intro',
            'icoAbout' => 'about',
            'platform' => 'finance.platform',
            'icoTokenPrice' => 'finance.price',
            'hardCap' => 'finance.hardcap',
            'minCap' => 'finance.softcap',
            'raised' => 'finance.raised',
            'bonus' => 'finance.bonus',
            'openPresale' => 'dates.preIcoStart',
            'teamMember' => ['property' => 'team', 'normalizer' => 'Kami\IcoBundle\Normalizer\TeamMembersNormalizer'],
            'tokenType' => ['property' => 'finance.tokentype', 'normalizer' => 'Kami\IcoBundle\Normalizer\TokenTypeNormalizer'],
            'kyc' => ['property' => 'kyc', 'normalizer' => 'Kami\IcoBundle\Normalizer\KycNormalizer'],
//            'smartContractAudit' => '',
//            'teamTokens' => '',
            'industries' => ['property'=>'categories', 'normalizer'=>'Kami\IcoBundle\Normalizer\IndustryNormalizer'],
//            'acceptingAssets' => 'finance.accepting',
            'restrictedCountries' => ['property'=>'restrictions', 'normalizer' => 'Kami\IcoBundle\Normalizer\RestrictedCountriesNormalizer']
        ];
    }
}