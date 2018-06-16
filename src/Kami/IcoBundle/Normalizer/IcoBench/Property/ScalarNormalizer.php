<?php


namespace Kami\IcoBundle\Normalizer\IcoBench\Property;


use Kami\IcoBundle\Normalizer\PropertyNormalizerInterface;

class ScalarNormalizer implements PropertyNormalizerInterface
{
    public function normalize($value)
    {
        return $value;
    }
}