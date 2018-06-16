<?php


namespace Kami\IcoBundle\Normalizer\IcoBench\Property;


use Kami\IcoBundle\Normalizer\AbstractPropertyNormalizer;

class DateTimeNormalizer extends AbstractPropertyNormalizer
{
    public function normalize($remoteData): ?\DateTime
    {
        $date = \DateTime::createFromFormat('Y-m-d G:i:s', $remoteData);
        if($remoteData === $date->format('Y-m-d G:i:s')) {

            return $date;
        }

        return null;
    }

}