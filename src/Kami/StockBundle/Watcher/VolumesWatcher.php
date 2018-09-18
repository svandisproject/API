<?php


namespace Kami\StockBundle\Watcher;

use Cassandra\BatchStatement;
use Cassandra\Exception\ExecutionException;
use Cassandra\SimpleStatement;
use Doctrine\ORM\EntityManager;
use Kami\AssetBundle\Entity\Asset;
use Kami\StockBundle\ChangesHelper\ChangesHelper;
use Kami\StockBundle\Watcher\Bitfinex\BitfinexVolumeWatcher;
use Kami\StockBundle\Watcher\Bittrex\BittrexVolumeWatcher;
use Kami\StockBundle\Watcher\Binance\BinanceVolumeWatcher;
use Kami\StockBundle\Watcher\Poloniex\PoloniexVolumeWatcher;
use Predis\Client;
use M6Web\Bundle\CassandraBundle\Cassandra\Client as CassandraClient;
use Psr\Log\LoggerInterface;
use Pusher\Pusher;
use Pusher\PusherException;

class VolumesWatcher
{
    /**
     * @var BittrexVolumeWatcher
     */
    public $bittrexVolumeWatcher;

    /**
     * @var BinanceVolumeWatcher
     */
    public $binanceVolumeWatcher;

    /**
     * @var PoloniexVolumeWatcher
     */
    public $poloniexVolumeWatcher;

    /**
     * @var BitfinexVolumeWatcher
     */
    public $bitfinexVolumeWatcher;

    /**
     * @var EntityManager
     */
    public $em;

    /**
     * @var Client
     */
    public $redis;

    /**
     * @var CassandraClient
     */
    protected $cassandra;

    /**
     * @var ChangesHelper
     */
    protected $changesHelper;

    /**
     * @var Pusher
     */
    protected $pusher;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * VolumesWatcher constructor.
     * @param BittrexVolumeWatcher $bittrexVolumeWatcher
     * @param BinanceVolumeWatcher $binanceVolumeWatcher
     * @param BitfinexVolumeWatcher $bitfinexVolumeWatcher
     * @param PoloniexVolumeWatcher $poloniexVolumeWatcher
     * @param EntityManager $em
     * @param Client $redis
     * @param CassandraClient $cassandra
     * @param ChangesHelper $changesHelper
     * @param Pusher $pusher
     * @param LoggerInterface $logger
     */
    function __construct(
        BittrexVolumeWatcher $bittrexVolumeWatcher,
        BinanceVolumeWatcher $binanceVolumeWatcher,
        BitfinexVolumeWatcher $bitfinexVolumeWatcher,
        PoloniexVolumeWatcher $poloniexVolumeWatcher,
        EntityManager $em,
        Client $redis,
        CassandraClient $cassandra,
        ChangesHelper $changesHelper,
        Pusher $pusher,
        LoggerInterface $logger
    )
    {
        $this->bittrexVolumeWatcher = $bittrexVolumeWatcher;
        $this->binanceVolumeWatcher = $binanceVolumeWatcher;
        $this->bitfinexVolumeWatcher = $bitfinexVolumeWatcher;
        $this->poloniexVolumeWatcher = $poloniexVolumeWatcher;
        $this->em = $em;
        $this->redis = $redis;
        $this->cassandra = $cassandra;
        $this->changesHelper = $changesHelper;
        $this->pusher = $pusher;
        $this->logger = $logger;
    }

    /**
     * @throws \Cassandra\Exception
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function getVolumes()
    {
        $this->bittrexVolumeWatcher->updateVolumes();

        $this->binanceVolumeWatcher->updateVolumes();

        $this->bitfinexVolumeWatcher->updateVolumes();

        $this->poloniexVolumeWatcher->updateVolumes();

        $this->setAssetsPrices();
    }

    /**
     * @throws \Cassandra\Exception
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    private function setAssetsPrices()
    {
        $assets = $this->em->getRepository(Asset::class)->findAll();
        foreach ($assets as $asset){

            $ticker = $asset->getTicker();
            $preparedTicker = strtolower(str_replace(" ", "_", trim($ticker)));
            if($data = $this->redis->get($ticker) )
            {
                if ($this->redis->get('price_' . $ticker)) {
                    $data = json_decode($data, true);
                    $soldAsset = 0;
                    $thisYear = intval(date("Y"));
                    foreach ($data as $exhange => $volume){
                        $query = "SELECT id, exchange, price, year, max(time) FROM svandis_asset_prices.price_" .
                            $preparedTicker . " WHERE year=" . $thisYear . " AND exchange = '$exhange' ALLOW FILTERING";

                        $statement = new SimpleStatement($query);
                        $result = $this->cassandra->executeAsync($statement);
                        foreach ($result->get() as $row) {
                            if ($row['price'] != null && $row['price']->value() != 0) {
                                $soldAsset += $volume / $row['price']->value();
                            }
                        }
                    }

                    if($soldAsset != 0){
                        $avgPrice = array_sum($data) / $soldAsset;

                        if(!$this->redis->get('avg_price_' . $preparedTicker)) {
                            $this->createCassandraAveragePriceTable($preparedTicker, $this->cassandra);
                            $this->redis->set('avg_price_' . $preparedTicker, $preparedTicker);
                        }
                        $this->storeAvgPrice($preparedTicker, $avgPrice, array_sum($data));
                        $asset->setPrice($avgPrice);
                        $asset->setChange($this->changesHelper->setChanges($asset, 'day'));
                        $asset->setWeeklyChange($this->changesHelper->setChanges($asset, 'week'));
                        $asset->setYearToDayChange($this->changesHelper->setChanges($asset, 'year'));
                        $this->em->persist($asset);
                        $this->push($asset, $avgPrice, array_sum($data));
                    }
                }
            }
        }
        $this->em->flush();

    }

    /**
     * @param string $ticker
     * @param float $avgPrice
     * @param float $volume
     * @throws \Cassandra\Exception
     */
    private function storeAvgPrice($ticker, $avgPrice, $volume)
    {
        $prepared = $this->cassandra->prepare(
            'INSERT INTO svandis_asset_prices.avg_price_' . $ticker . ' (ticker, price, volume, time) 
                        VALUES (?, ?, ?, toUnixTimestamp(now()));'
        );
        $batch = new BatchStatement(\Cassandra::BATCH_LOGGED);

        $batch->add($prepared, [
            'ticker' => $ticker,
            'price' =>  new \Cassandra\Float(floatval($avgPrice)),
            'volume' =>  new \Cassandra\Float(floatval($volume)),
        ]);

        $this->cassandra->executeAsync($batch);
    }

    private function createCassandraAveragePriceTable($ticker, $cassandra)
    {
        try {
            $statement = $cassandra->prepare(
                'CREATE TABLE if NOT EXISTS svandis_asset_prices.avg_price_' . $ticker . '
                    ( ticker text, price float, volume float, time timestamp , PRIMARY KEY (ticker, time ))
                    with clustering order by (time desc);'
            );
            $cassandra->execute($statement);
        } catch (ExecutionException $exception) {
            echo $exception->getMessage();
        }
    }


    /**
     * @param Asset $asset
     * @param float $avgPrice
     * @param float $volume
     * @throws \Cassandra\Exception
     */
    private function push(Asset $asset, $avgPrice, $volume){
        try {
            $this->pusher->trigger('token', 'token', [
                'message' => [
                    'ticker' => $asset->getTicker(),
                    'price' => $avgPrice,
                    'volume' => $volume,
                    'change' => $asset->getChange(),
                    'weeklyChange' => $asset->getWeeklyChange(),
                    'yearToDayChange' => $asset->getYearToDayChange(),
                ]
            ]);
        } catch (PusherException $exception) {
            $this->logger->error('Failed to send a pusher message');
        }
    }
}
