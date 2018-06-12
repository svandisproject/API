<?php


namespace Kami\IcoBundle\Normalizer\IcoBench;


use Kami\IcoBundle\Entity\Industry;
use Kami\IcoBundle\Normalizer\AbstractIcoNormalizer;
use Kami\IcoBundle\Entity\Ico;

class IndustryNormalizer extends AbstractIcoNormalizer
{
    public function normalize(Ico $ico, $remoteData): Ico
    {
        foreach ($remoteData as $industry) {
            $ico->addIndustry($this->findOrCreateIndustry($industry));
        }
        return $ico;
    }

    /**
     * @param array $remoteArray
     * @return Industry
     *
     * @throws \Doctrine\ORM\ORMException
     */
    protected function findOrCreateIndustry($remoteArray) : Industry
    {
        $industry = $this->entityManager->getRepository(Industry::class)->findOneBy(['title' => $remoteArray['name']]);
        if (!$industry) {
            $industry = new Industry();
            $industry->setTitle($remoteArray['name']);
            $this->entityManager->persist($industry);
        }
        return $industry;
    }

    public function getNormalizingMap(): array
    {
        return [];
    }
}