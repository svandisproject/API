<?php


namespace Kami\IcoBundle\Normalizer;

use Doctrine\ORM\EntityManager;
use Kami\IcoBundle\Entity\Ico;
use Kami\IcoBundle\Entity\Kyc;

class KycNormalizer
{
    private $entityManager;

    public function __construct(EntityManager $manager)
    {
        $this->entityManager = $manager;
    }

    public function normalize($remoteKyc, Ico $ico)
    {

        if(!empty($remoteKyc)){
            foreach ($remoteKyc['invited'] as $kycMember){
                if(!$kycPerson = $this->entityManager->getRepository(Kyc::class)->findOneBy(['name'=>$kycMember['name']])) {
                    $kycPerson = new Kyc();
                }
                $kycPerson->setName($kycMember['name']);

                $kycPerson->setStatus($kycMember['status']);

                $this->entityManager->persist($kycPerson);
                $this->entityManager->flush();
                $ico->addKyc($kycPerson);
            }
        }
    }
}