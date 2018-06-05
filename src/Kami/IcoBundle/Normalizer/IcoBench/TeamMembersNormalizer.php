<?php


namespace Kami\IcoBundle\Normalizer\IcoBench;

use Kami\IcoBundle\Normalizer\AbstractIcoNormalizer;
use Kami\IcoBundle\Entity\Ico;
use Kami\IcoBundle\Entity\Person;

class TeamMembersNormalizer extends AbstractIcoNormalizer
{
    public function fromRemote(Ico $ico, $remoteData)
    {
        foreach ($remoteData as $person){
            $person = $this->findOrCreatePerson($person['url'], $person);
            $ico->addTeamMember($person);
        }
    }

    protected function findOrCreatePerson($link, $remoteData)
    {
        $person = $this->entityManager->getRepository(Person::class)->findOneBy(['link' => $link]);
        if (!$person) {
            $person = new Person();
            $person->setName($remoteData['name']);
            if($remoteData['title']){
                $person->setTitle($remoteData['title']);
            }
            if($remoteData['group']){
                $person->setSubdivision($remoteData['group']);
            }
            $person->setLink($link);
            $this->entityManager->persist($person);
        }

        return $person;
    }

    public function getPropertyMap(): array
    {
        return [];
    }
}