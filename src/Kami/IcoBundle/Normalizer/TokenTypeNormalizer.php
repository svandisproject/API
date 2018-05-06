<?php


namespace Kami\IcoBundle\Normalizer;

use Doctrine\ORM\EntityManager;
use Kami\IcoBundle\Entity\Ico;
use Kami\IcoBundle\Entity\TokenType;

class TokenTypeNormalizer
{
    private $entityManager;

    public function __construct(EntityManager $manager)
    {
        $this->entityManager = $manager;
    }

    public function normalize($icobenchType, Ico $ico)
    {
        if($icobenchType){
            if (!$tokenType = $this->entityManager->getRepository(TokenType::class)->findOneBy(['title' => $icobenchType])){
                $tokenType = new TokenType();
            }
            $tokenType->setTitle($icobenchType);
            $this->entityManager->persist($tokenType);
            $this->entityManager->flush();

            $ico->setTokenType($tokenType);
        }
    }
}