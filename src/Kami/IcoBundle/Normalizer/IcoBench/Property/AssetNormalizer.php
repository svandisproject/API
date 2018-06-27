<?php


namespace Kami\IcoBundle\Normalizer\IcoBench\Property;


use Kami\AssetBundle\Entity\Asset;
use Kami\IcoBundle\Normalizer\AbstractPropertyNormalizer;


class AssetNormalizer extends AbstractPropertyNormalizer
{

    public function normalize($remoteData): ?Asset
    {
       return $this->findAsset($remoteData);
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
}