<?php


namespace Kami\IcoBundle\Normalizer\IcoBench;

use Kami\IcoBundle\Entity\Country;
use Kami\IcoBundle\Entity\Ico;
use Kami\IcoBundle\Normalizer\AbstractIcoNormalizer;

class IcoCountryNormalizer extends AbstractIcoNormalizer
{
    /**
     * @param Ico $ico
     * @param $remoteData
     * @return Ico
     */
    public function normalize(Ico $ico, $remoteData): Ico
    {
        $ico->setCountryId($this->findOrCreateCountry($remoteData));
        return $ico;
    }

    /**
     * @param string $title
     * @return Country|object
     */
    protected function findOrCreateCountry($title)
    {

        $country = $this->entityManager->getRepository(Country::class)->findOneBy(['title' => $title]);

        if (!$country) {
            $country = new Country();
            $country->setTitle($title);
            $this->entityManager->persist($country);
        }

        return $country;
    }

    public function getNormalizingMap(): array
    {
        return [];

    }
}
