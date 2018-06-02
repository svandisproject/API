<?php


namespace Kami\IcoBundle\Normalizer\IcoBench;
use Kami\IcoBundle\Normalizer\AbstractIcoNormalizer;

use Kami\IcoBundle\Entity\Ico;
use Kami\IcoBundle\Entity\Kyc;

class KycNormalizer extends AbstractIcoNormalizer
{
    public function fromRemote(Ico $ico, $remoteData)
    {
        foreach ($remoteData['invited'] as $kycMember) {
            $kyc = $this->findOrCreateKyc($kycMember['name'], $kycMember['status']);
            $ico->addKyc($kyc);
        }
    }

    /**
     * @param $name
     * @param $status
     *
     * @return Kyc
     * @throws \Doctrine\ORM\ORMException
     */
    protected function findOrCreateKyc($name, $status)
    {
        $kyc = $this->entityManager->getRepository(Kyc::class)
            ->findOneBy([
                'name' => $name,
                'status' => $status
            ]);

        if(!$kyc) {
            $kyc = new Kyc();
            $kyc->setName($name)
                ->setStatus($status);

            $this->entityManager->persist($kyc);
        }

        return $kyc;
    }

    public function getPropertyMap(): array
    {
        return [];
    }
}