<?php

namespace Kami\StockBundle;

use Cassandra\BatchStatement;
use Cassandra\Exception\ExecutionException;
use Cassandra\Timeuuid;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Kami\AssetBundle\Entity\Asset;
use Kami\AssetBundle\Entity\Pair;
use M6Web\Bundle\CassandraBundle\Cassandra\Client as CassandraClient;
use Psr\Log\LoggerInterface;
use GuzzleHttp\Client as HttpClient;
use Predis\Client;

abstract class AbstractCandlesWatcher
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

    abstract public function updateAssetCandles();

    /**
     * @param array $candlesData
     * @param string $exchange
     * @throws \Cassandra\Exception
     * @return void
     */
    protected function persistCandles($candlesData, $exchange)
    {
        $cassandra = $this->client;

        $preparedExchange = strtolower(str_replace(" ", "_", trim($exchange)));

        foreach ($candlesData as $ticker => $exchangeData) {

            $preparedTicker = strtolower(str_replace(" ", "_", trim($ticker)));
            //TODO remove comments
//            if(!$this->redis->get('candles_' . $preparedTicker . '_' . $preparedExchange)) {
                $this->createCassandraAssetCandlesTable($cassandra, $preparedTicker, $preparedExchange);
//                $this->redis->set('candles_' . $preparedTicker . '_' . $preparedExchange, $preparedTicker);
//            }

            foreach ($exchangeData as $pair => $globalData) {

                $token = str_replace($ticker, '', $pair);

                $position = strpos($pair, $ticker);
                switch ($position) {
                    case 0:
                        $asset1 = $ticker;
                        $asset2 = $token;
                        break;
                    case $position>0:
                        $asset1 = $token;
                        $asset2 = $ticker;
                }

                foreach ($globalData as $candles) {
                    foreach ($candles as $time => $points) {

                        $prepared = $cassandra->prepare(
                        'INSERT INTO svandis_asset_prices.candles_' . $preparedTicker . '_' . $preparedExchange .
                        ' (aset_1, asset_2, pair, exchange, open_time, open_price, close_price, high_price, low_price)
                         VALUES (?, ?, ?, ?, toTimestamp('.new Timeuuid(intval($time)).'), ?, ?, ?, ?);'
                    );
                    $batch = new BatchStatement(\Cassandra::BATCH_LOGGED);
                    $batch->add($prepared, [
                        'asset_1' => $asset1,
                        'asset_2' => $asset2,
                        'pair' => $pair,
                        'exchange' => $exchange,
                        'open_price' => new \Cassandra\Float(floatval($points['open'])),
                        'close_price' => new \Cassandra\Float(floatval($points['close'])),
                        'high_price' => new \Cassandra\Float(floatval($points['high'])),
                        'low_price' => new \Cassandra\Float(floatval($points['low'])),
                    ]);

                    $cassandra->execute($batch);

                    }
                }
            }

        }

    }

    /**
     * @param string $ticker
     * @throws ORMInvalidArgumentException
     * @throws ORMException
     * @return Asset
     */
    protected function findOrCreateAsset( $ticker) :Asset
    {
        if (!$asset = $this->entityManager->getRepository(Asset::class)->findOneBy(['ticker' => $ticker])) {
            $asset = new Asset();
            $asset->setTicker($ticker);
            $this->entityManager->persist($asset);
            $this->entityManager->flush();
        }

        return $asset;
    }

    protected function createCassandraAssetCandlesTable ($cassandra, $ticker, $exchange)
    {
        try {
            $statement = $cassandra->prepare(
                'CREATE TABLE if NOT EXISTS svandis_asset_prices.candles_' . $ticker . '_' . $exchange . '
                    (aset_1 text, asset_2 text, pair text, exchange text, open_time timestamp, open_price float, close_price float,
                     high_price float, low_price float PRIMARY KEY (pair, open_time)) WITH CLUSTERING ORDER BY (open_time DESC);'
            );
            $cassandra->execute($statement);
        } catch (ExecutionException $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * @param array $globalData
     * @param string $exchange
     * @return mixed
     */
    protected function findOrCreatePair($globalData, $exchange): Pair
    {
        foreach ($globalData as $ticker => $data) {

            $asset = $this->findOrCreateAsset($ticker);
            foreach ($data as $pairName => $candlesData) {
                if (!$pair = $this->entityManager->getRepository(Pair::class)->findBy(['pair' => $pairName])) {
                    $pair = new Pair();
                }
                    $pair->setPair($pairName);
                    $pair->setExchange($exchange);
                    $pair->setAsset($asset);
                    $this->entityManager->persist($pair);
                    $this->entityManager->flush();
            }
        }
        return true;
    }

}