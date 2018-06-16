<?php


namespace Kami\IcoBundle\Normalizer\IcoBench\Property;

use Kami\IcoBundle\Entity\Person;
use Kami\IcoBundle\Normalizer\AbstractPropertyNormalizer;

class TeamNormalizer extends AbstractPropertyNormalizer
{

    public function normalize($remoteData): array
    {
        $unique = [];
        $team = [];
        foreach ($remoteData as $person) {
            if(!in_array($person['url'], $unique)) {
                $team[] = $this->findOrCreatePerson($person);
            }
            array_push($unique, $person['url']);
        }
        return $team;
    }

    /**
     * @param array $person
     * @return Person
     *
     * @throws \Doctrine\ORM\ORMException
     */
    protected function findOrCreatePerson($person) : Person
    {
        $teamMember = $this->entityManager->getRepository(Person::class)->findOneBy(['url' => $person['url']]);
        if (!$teamMember) {
            $teamMember = new Person();
            $teamMember->setName($person['name']);
            if ($person['links'] && strlen($person['links']) <= 255) {
                $teamMember->setLinks($person['links']);
            }
            $teamMember->setUrl($person['url']);
            $this->entityManager->persist($teamMember);
        }
        return $teamMember;
    }

}