<?php

namespace Kami\IcoBundle\Normalizer\IcoBench;

use Kami\IcoBundle\Entity\Country;
use Kami\IcoBundle\Entity\Ico;
use Kami\IcoBundle\Normalizer\AbstractIcoNormalizer;
use function mb_strimwidth;
use function strlen;

class RestrictedCountriesNormalizer extends AbstractIcoNormalizer
{

    /**
     * @param Ico $ico
     * @param $remoteData
     * @return Ico
     */
    public function normalize(Ico $ico, $remoteData): Ico
    {
       if (!empty($remoteData)) {
           foreach ($remoteData as $item) {
               $ico->addRestricted($this->findOrCreateCountry($item['country']));
//               $ico->addRestrictedCountry($item['country']);
           }
       }
       return $ico;
    }

    /**
     * @param string $title
     * @return Country|object
     */
    protected function findOrCreateCountry($title)
    {
        if (strlen($title) >= 100) {
            $title = mb_strimwidth($title, 0, 99);
        }

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