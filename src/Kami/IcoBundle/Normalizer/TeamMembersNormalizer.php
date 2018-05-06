<?php


namespace Kami\IcoBundle\Normalizer;

use Doctrine\ORM\EntityManager;
use Kami\IcoBundle\Entity\Ico;
use Kami\IcoBundle\Entity\Person;

class TeamMembersNormalizer
{
    private $entityManager;

    public function __construct(EntityManager $manager)
    {
        $this->entityManager = $manager;
    }

    public function normalize($icobenchTeam, Ico $ico)
    {
        foreach ($icobenchTeam as $person){

            if(!$member = $this->entityManager->getRepository(Person::class)->findOneBy(['link'=>$person['links']])) {
                $member = new Person();
            }
            $member->setName($person['name']);
            if($person['title']){
                $member->setTitle($person['title']);
            }
            if($person['group']){
                $member->setSubdivision($person['group']);
            }
            $member->setLink($person['links']);
            $this->entityManager->persist($member);
            $this->entityManager->flush();
            $ico->addTeamMember($member);
        }
    }

}