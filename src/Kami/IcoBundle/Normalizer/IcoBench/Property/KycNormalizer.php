<?php


namespace Kami\IcoBundle\Normalizer\IcoBench\Property;


use Kami\IcoBundle\Normalizer\AbstractPropertyNormalizer;

class KycNormalizer extends AbstractPropertyNormalizer
{

    public function normalize($remoteData): bool
    {
        return !empty ($remoteData['invited']);
    }

    public function getNormalizingMap(): array
    {
        return [];
    }
}