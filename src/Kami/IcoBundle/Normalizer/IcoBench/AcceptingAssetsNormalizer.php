<?php


namespace Kami\IcoBundle\Normalizer\IcoBench;


use function explode;
use Kami\AssetBundle\Entity\Asset;
use Kami\IcoBundle\Entity\Ico;
use Kami\IcoBundle\Normalizer\AbstractIcoNormalizer;

class AcceptingAssetsNormalizer extends AbstractIcoNormalizer
{
    /**
     * @param Ico $ico
     * @param string $remoteData
     * @throws \Doctrine\ORM\ORMException
     *
     * @return mixed
     */
    public function fromRemote(Ico $ico, $remoteData)
    {
        $ico->removeAssets();
        if ($remoteData) {
            $assetsArray = explode(', ', $remoteData);
            foreach ($assetsArray as $assetSymbol) {
                if ($asset = $this->findAsset($assetSymbol)) {
                    $ico->addAcceptingAsset($asset);
                }
            }
        }
        return;
    }

    /**
     * @param $symbol
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\ORMException
     */
    protected function findAsset($symbol)
    {
        if (!$asset = $this->entityManager->getRepository(Asset::class)->findOneBy(['symbol' => $symbol])) {
            $asset = $this->entityManager ->getRepository(Asset::class) ->findOneBy(['name' => $symbol]);
        }

        return $asset;
    }

    public function getPropertyMap() : array
    {
        return [];
    }
}