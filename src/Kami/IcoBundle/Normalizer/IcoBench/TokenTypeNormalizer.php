<?php


namespace Kami\IcoBundle\Normalizer\IcoBench;
use Kami\IcoBundle\Normalizer\AbstractIcoNormalizer;

use Kami\IcoBundle\Entity\Ico;
use Kami\IcoBundle\Entity\TokenType;

class TokenTypeNormalizer extends AbstractIcoNormalizer
{
    public function fromRemote(Ico $ico, $remoteData)
    {
        $tokenType = $this->findOrCreateTokenType($remoteData);
        $ico->setTokenType($tokenType);
    }

    protected function findOrCreateTokenType($title)
    {
        $tokenType = $this->entityManager->getRepository(TokenType::class)
            ->findOneBy(['title' => $title]);

        if (!$tokenType) {
            $tokenType = new TokenType();
            $tokenType->setTitle($title);
            $this->entityManager->persist($tokenType);
        }

        return $tokenType;
    }

    public function getPropertyMap(): array
    {
        return [];
    }


}