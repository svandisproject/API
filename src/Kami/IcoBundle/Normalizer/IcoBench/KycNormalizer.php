<?php


namespace Kami\IcoBundle\Normalizer\IcoBench;


use const false;
use Kami\IcoBundle\Entity\Ico;
use Kami\IcoBundle\Normalizer\AbstractIcoNormalizer;

class KycNormalizer extends AbstractIcoNormalizer
{
    /**
     * @param Ico $ico
     * @param $remoteData
     * @return Ico
     */
    public function normalize(Ico $ico, $remoteData): Ico
    {
        !empty ($remoteData['invited']) ? $ico->setKyc(true) : $ico->setKyc(false);
        return $ico;
    }

    public function getNormalizingMap(): array
    {
        return [];
    }
}