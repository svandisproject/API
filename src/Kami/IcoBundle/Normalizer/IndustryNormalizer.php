<?php


namespace Kami\IcoBundle\Normalizer;

use Doctrine\ORM\EntityManager;
use Kami\IcoBundle\Entity\Industry;

class IndustryNormalizer
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function normalize($remoteIndustries, $ico)
    {
        if(!empty($remoteIndustries)){
            foreach ($remoteIndustries as $remoteIndustry){
                if(!$industry = $this->entityManager->getRepository(Industry::class)->findOneBy(['title'=>$remoteIndustry['name']])){
                    $industry = new Industry();
                }
                $industry->setTitle($remoteIndustry['name']);
                $this->entityManager->persist($industry);
                $this->entityManager->flush();
                $ico->addIndustry($industry);
            }
        }
    }

}