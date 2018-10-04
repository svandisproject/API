<?php

namespace Kami\StockBundle\Watcher;

use Cassandra\BatchStatement;
use Cassandra\Exception\ExecutionException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Kami\AssetBundle\Entity\Asset;
use Kami\StockBundle\Model\Point;
use M6Web\Bundle\CassandraBundle\Cassandra\Client as CassandraClient;
use Psr\Log\LoggerInterface;
use GuzzleHttp\Client as HttpClient;
use Predis\Client;

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
     * @var Client
     */
    protected $redis;

    /**
     * @var bool
     */
    protected $useProxy = false;

    /**
     * AbstractExchangeWatcher constructor.
     * @param CassandraClient $client
     * @param EntityManager $manager
     * @param LoggerInterface $logger
     * @param Client $redis
     * @param string $proxy
     */
    public function __construct(
        CassandraClient $client,
        EntityManager $manager,
        LoggerInterface $logger,
        Client $redis,
        $proxy
    )
    {
        $this->entityManager = $manager;
        $this->client = $client;
        $this->logger = $logger;
        $this->redis = $redis;

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
        $pointDbValues = $point->toDatabaseValues();
        $ticker = $pointDbValues['asset'];
        $preparedTicker = strtolower(str_replace(" ", "_", trim($ticker)));

        if(!$this->redis->get('price_' . $ticker)) {
            $this->createCassandraAssetPriceTable($cassandra, $preparedTicker);
            $this->redis->set('price_' . $ticker, $preparedTicker);
        }

        $prepared = $cassandra->prepare(
            'INSERT INTO svandis_asset_prices.price_' . $preparedTicker . ' (price, exchange, time) 
              VALUES (?, ?, toUnixTimestamp(now()));'
        );
        $batch = new BatchStatement(\Cassandra::BATCH_LOGGED);
        $batch->add($prepared, [
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

    protected function createCassandraAssetPriceTable ($cassandra, $ticker)
    {
        try {
            $statement = $cassandra->prepare(
                'CREATE TABLE if NOT EXISTS svandis_asset_prices.price_' . $ticker . '
                    ( exchange text, price float, time timestamp , PRIMARY KEY (exchange, time)) 
                    WITH CLUSTERING ORDER BY (time DESC);'
            );
            $cassandra->execute($statement);
        } catch (ExecutionException $exception) {
            echo $exception->getMessage();
        }
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