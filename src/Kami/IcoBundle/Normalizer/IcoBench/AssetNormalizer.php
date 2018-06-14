<?php


namespace Kami\IcoBundle\Normalizer\IcoBench;


use Kami\AssetBundle\Entity\Asset;
use Kami\IcoBundle\Entity\Ico;
use Kami\IcoBundle\Normalizer\AbstractIcoNormalizer;

class AssetNormalizer extends AbstractIcoNormalizer
{

    public function normalize(Ico $ico, $remoteData): Ico
    {

       $asset = $this->findAsset($remoteData);

       return $ico->setAsset($asset);
    }

    /**
     * @param string $symbol
     * @return Asset | null
     *
     * @throws \Doctrine\ORM\ORMException
     */
    protected function findAsset($symbol)
    {
        $asset = $this->entityManager
            ->getRepository(Asset::class)
            ->findOneBy(['title' => $symbol]);

        return $asset;
    }

    public function getNormalizingMap(): array
    {
        return [];
    }
}