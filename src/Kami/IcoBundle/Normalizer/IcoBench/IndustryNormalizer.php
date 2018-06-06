<?php


namespace Kami\IcoBundle\Normalizer\IcoBench;
use Kami\IcoBundle\Entity\Ico;
use Kami\IcoBundle\Normalizer\AbstractIcoNormalizer;
use Kami\IcoBundle\Entity\Industry;

class IndustryNormalizer extends AbstractIcoNormalizer
{

    /**
     * @param Ico $ico
     * @param array $remoteData
     * @throws \Doctrine\ORM\ORMException
     */
    public function fromRemote(Ico $ico, $remoteData)
    {
        foreach ($remoteData as $industry) {
            $industry = $this->findOrCreateIndustry($industry['name']);
            $ico->addIndustry($industry);
        }
    }

    /**
     * @param $name
     * @return Industry
     *
     * @throws \Doctrine\ORM\ORMException
     */
    protected function findOrCreateIndustry($name) : Industry
    {
        $industry = $this->entityManager
            ->getRepository(Industry::class)
            ->findOneBy(['title' => $name]);
        if (!$industry) {
            $industry = new Industry();
            $industry->setTitle($name);
            $this->entityManager->persist($industry);
        }

        return $industry;
    }

    public function getPropertyMap() : array
    {
        return [];
    }
}