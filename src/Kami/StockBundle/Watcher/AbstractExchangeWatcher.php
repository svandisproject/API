<?php

namespace Kami\StockBundle\Watcher;


use Cassandra\BatchStatement;
use Cassandra\Uuid;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Kami\AssetBundle\Entity\Asset;
use Kami\StockBundle\Model\Point;
use M6Web\Bundle\CassandraBundle\Cassandra\Client as CassandraClient;
use Psr\Log\LoggerInterface;
use GuzzleHttp\Client as HttpClient;

abstract class AbstractExchangeWatcher
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var CassandraClient
     */
    protected $client;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var bool
     */
    protected $useProxy = false;

    /**
     * AbstractExchangeWatcher constructor.
     * @param CassandraClient $client
     * @param EntityManager $manager
     * @param LoggerInterface $logger
     * @param string $proxy
     */
    public function __construct(CassandraClient $client, EntityManager $manager, LoggerInterface $logger, $proxy)
    {
        $this->entityManager = $manager;
        $this->client = $client;
        $this->logger = $logger;

        if ($this->useProxy) {
            $this->httpClient = new HttpClient(['proxy'=>$proxy]);
        }
    }

    abstract public function updateAssetPrices();

    abstract public function getUsdPrices(array $data);

    /**
     * @param Point $point
     * @param string $exchange
     * @throws \Cassandra\Exception
     * @return void
     */
    protected function persistPoint(Point $point, $exchange)
    {
        $cassandra = $this->client;
        $prepared = $cassandra->prepare(
            'INSERT INTO svandis_asset_prices.asset_price (id, ticker, price, exchange, time) 
              VALUES (?, ?, ?, ?, toUnixTimestamp(now()));'
        );
        $batch = new BatchStatement(\Cassandra::BATCH_LOGGED);
        $pointDbValues = $point->toDatabaseValues();

        $batch->add($prepared, [
            'id' => new Uuid(\Ramsey\Uuid\Uuid::uuid1()->toString()),
            'ticker' => $pointDbValues['asset'],
            'price' =>  new \Cassandra\Float($pointDbValues['price']),
            'exchange' =>  $exchange,
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
            $asset->setTicker($tickerData['asset']);
            $this->entityManager->persist($asset);
            $this->entityManager->flush();
        }

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