<?php


namespace Kami\IcoBundle\Normalizer\IcoBench\Property;


use Kami\IcoBundle\Entity\Industry;
use Kami\IcoBundle\Normalizer\AbstractPropertyNormalizer;

class IndustryNormalizer extends AbstractPropertyNormalizer
{
    public function normalize($remoteData): array
    {
        $uniqueIndustries = array_unique($remoteData, SORT_REGULAR);
        $industries = [];
        foreach ($uniqueIndustries as $industry) {
           $industries[] = $this->findOrCreateIndustry($industry);
        }
        return $industries;
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