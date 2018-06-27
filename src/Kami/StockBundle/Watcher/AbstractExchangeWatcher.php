<?php

namespace Kami\StockBundle\Watcher;


use Cassandra\BatchStatement;
use Cassandra\Uuid;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Kami\AssetBundle\Entity\Asset;
use Kami\StockBundle\Model\Point;
use M6Web\Bundle\CassandraBundle\Cassandra\Client;

abstract class AbstractExchangeWatcher
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var Client
     */
    protected $client;

    /**
     *
     * @param Client $client
     * @param EntityManager $manager
     */
    public function __construct(Client $client, EntityManager $manager)
    {
        $this->entityManager = $manager;
        $this->client = $client;
    }

    abstract public function updateAssetPrices();

    abstract public function getUsdPrices(array $data);

    /**
     * @param Point $point
     * @throws \Cassandra\Exception
     * @return void
     */
    protected function persistPoint(Point $point)
    {
        $cassandra = $this->client;
        $prepared = $cassandra->prepare(
            'INSERT INTO svandis_asset_prices.asset_price (id, ticker, price, time) 
              VALUES (?, ?, ?, toTimeStamp(toDate(now())));'
        );
        $batch = new BatchStatement(\Cassandra::BATCH_LOGGED);
        $pointDbValues = $point->toDatabaseValues();

        $batch->add($prepared, [
            'id' => new Uuid(\Ramsey\Uuid\Uuid::uuid1()->toString()),
            'ticker' => $pointDbValues['asset'],
            'price' =>  new \Cassandra\Float($pointDbValues['price'])
        ]);

        $cassandra->execute($batch);
    }

    /**
     * @param array $tickerData
     * @throws ORMInvalidArgumentException
     * @throws ORMException
     * @return Asset
     */
    protected function findOrCreateAsset(array $tickerData) :Asset
    {
        if (!$asset = $this->entityManager->getRepository(Asset::class)->findOneBy(['ticker' => $tickerData['asset']])) {
            $asset = new Asset();
        }
        $asset->setPrice($tickerData['price']);
        $asset->setTicker($tickerData['asset']);
        $this->entityManager->persist($asset);
        $this->entityManager->flush();

        return $asset;
    }

    /**
     * @param array
     * @throws ORMInvalidArgumentException
     * @throws ORMException
     * @return Point
     */
    protected function createNewPoint(array $tickerData) :Point
    {
        $asset = $this->findOrCreateAsset($tickerData);
        $point = new Point($asset, new \DateTime(), $tickerData['price']);

        return $point;
    }

}