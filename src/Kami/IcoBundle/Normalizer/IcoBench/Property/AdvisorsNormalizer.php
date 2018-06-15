<?php


namespace Kami\IcoBundle\Normalizer\IcoBench\Property;

use Kami\IcoBundle\Entity\Person;
use Kami\IcoBundle\Normalizer\AbstractPropertyNormalizer;

class AdvisorsNormalizer extends AbstractPropertyNormalizer
{

    public function normalize($remoteData): array
    {
        foreach ($remoteData as $person) {
            $advisors = [];
            if ($person['name'] !== "Benchy") {
                $advisors[] = $this->findOrCreatePerson($person);

            }
        }
        return $advisors;
    }

    /**
     * @param array $person
     * @return Person
     *
     * @throws \Doctrine\ORM\ORMException
     */
    protected function findOrCreatePerson($person) : Person
    {
            $advisor = $this->entityManager->getRepository(Person::class)->findOneBy(['url' => $person['url']]);
            if (!$advisor) {
                $advisor = new Person();
                $advisor->setName($person['name']);
                $advisor->setUrl($person['url']);
            }
            return $advisor;
    }

}