<?php


namespace Kami\IcoBundle\Normalizer\IcoBench;

use Kami\IcoBundle\Entity\Ico;
use Kami\IcoBundle\Entity\Person;
use Kami\IcoBundle\Normalizer\AbstractIcoNormalizer;

class AdvisorsNormalizer extends AbstractIcoNormalizer
{

    public function normalize(Ico $ico, $remoteData): Ico
    {
        foreach ($remoteData as $person) {
            if ($person['name'] !== "Benchy") {
                $advisor = $this->findOrCreatePerson($person);
                $ico->addAdvisor($advisor);
            }
        }
        return $ico;
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

    public function getNormalizingMap(): array
    {
        return [];
    }

}