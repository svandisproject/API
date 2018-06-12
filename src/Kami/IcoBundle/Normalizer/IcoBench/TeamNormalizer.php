<?php


namespace Kami\IcoBundle\Normalizer\IcoBench;

use function array_push;
use function in_array;
use Kami\IcoBundle\Entity\Ico;
use Kami\IcoBundle\Entity\Person;
use Kami\IcoBundle\Normalizer\AbstractIcoNormalizer;

class TeamNormalizer extends AbstractIcoNormalizer
{

    public function normalize(Ico $ico, $remoteData): Ico
    {
        $uniq = [];
        foreach ($remoteData as $person) {
            if(!in_array($person['url'], $uniq)) {
                $teamMember = $this->findOrCreatePerson($person);
                $ico->addTeam($teamMember);
            }
            array_push($uniq, $person['url']);
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
        $teamMember = $this->entityManager->getRepository(Person::class)->findOneBy(['url' => $person['url']]);
        if (!$teamMember) {
            $teamMember = new Person();
            $teamMember->setName($person['name']);
            if ($person['links']) {
                $teamMember->setLinks($person['links']);
            }
            $teamMember->setUrl($person['url']);
            $this->entityManager->persist($teamMember);
        }
        return $teamMember;
    }

    public function getNormalizingMap(): array
    {
        return [];
    }

}