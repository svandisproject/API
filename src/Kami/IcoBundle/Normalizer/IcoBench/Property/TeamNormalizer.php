<?php


namespace Kami\IcoBundle\Normalizer\IcoBench\Property;

use Kami\IcoBundle\Entity\Person;
use Kami\IcoBundle\Normalizer\AbstractPropertyNormalizer;

class TeamNormalizer extends AbstractPropertyNormalizer
{

    public function normalize($remoteData, $ico): array
    {
        $unique = [];
        $team = [];
        foreach ($remoteData as $remotePersonData) {
            if ($remotePersonData['name'] !== "Benchy") {
                if (!in_array($remotePersonData['url'], $unique)) {
                    $team[] = $this->findOrCreatePerson($remotePersonData);
                }
                array_push($unique, $remotePersonData['url']);
            }
        }
        return $team;
    }

    /**
     * @param array $remotePersonData
     * @return Person
     *
     * @throws \Doctrine\ORM\ORMException
     */
    protected function findOrCreatePerson($remotePersonData) : Person
    {

        if (!$teamMember = $this->entityManager->getRepository(Person::class)->findOneBy(['url' => $remotePersonData['url']])) {
            $teamMember = new Person();
        }
        $teamMember->setName($remotePersonData['name']);
        $teamMember->setTitle($remotePersonData['title']);
        if (!empty($remotePersonData['socials'])) {
            $teamMember->setLinks($remotePersonData['socials']);
        }
        $teamMember->setUrl($remotePersonData['url']);
        if ($remotePersonData['group'] == 'Advisor') {
            $teamMember->setAdvisor(true);
        }
        if ($remotePersonData['photo']) {
            $teamMember->setPhoto($remotePersonData['photo']);
        }
        $this->entityManager->persist($teamMember);

        return $teamMember;
    }

}