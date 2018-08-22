<?php


namespace Kami\StockBundle\Watcher;


use Cassandra\BatchStatement;
use Cassandra\SimpleStatement;
use Doctrine\ORM\EntityManager;
use function dump;
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
        $this->redis->flushall();
        $this->bittrexVolumeWatcher->updateVolumes();
        $this->logger->warning("Bittrex volunes get!");

        $this->binanceVolumeWatcher->updateVolumes();
        $this->logger->warning('Binance done!!!!');

        $this->bitfinexVolumeWatcher->updateVolumes();
        $this->logger->warning('Bitfinex done!!!!');

        $this->poloniexVolumeWatcher->updateVolumes();
        $this->logger->warning('Poloniex done!!!!');

        $this->setAssetsPrices();
        $this->logger->warning('Asset prices calculate done!!!!');
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
            if($data = $this->redis->get($ticker))
            {

                $data = (array) json_decode($data);

                if ($ticker == 'EGC') {
                    $this->logger->warning($data);
                }
//                continue;
                $soldAsset = 0;

                foreach ($data as $exhange => $volume){
                    if ($ticker == 'EGC') {
                        $this->logger->warning("Exchange - " . $exhange);
                        $this->logger->warning("Volume - " . $volume);
                    }
                    $query = "SELECT id, exchange, price, ticker, max(time) FROM svandis_asset_prices.asset_price ".
                        "WHERE ticker = '$ticker' AND exchange = '$exhange' ALLOW FILTERING";

                    $statement = new SimpleStatement($query);
                    $result = $this->cassandra->executeAsync($statement);
                    foreach ($result->get() as $row) {
//                        dump($row['price']->value());
                        if ($row['price'] != null && $row['price']->value() != 0) {
                        $soldAsset += $volume / $row['price']->value();
                            if ($ticker == 'EGC') {
                                $this->logger->warning("Volume = " . $volume . " price = ".  $row['price']->value());
                            }
                    }
                    }
//                    if ($result[0]['price'] != null && $result[0]['price']->value() != 0) {
//                        $soldAsset += $volume / $result[0]['price']->value();
//                    }
                }
                if ($ticker == 'EGC') {
                    $this->logger->warning("Sold assets = " . $soldAsset);
                }
                if($soldAsset != 0){

                    $avgPrice = array_sum($data) / $soldAsset;
                    if ($ticker == 'EGC') {
                        $this->logger->warning("Array sum = " . array_sum($data));
                        $this->logger->warning("Data = " . $data);
                        $this->logger->warning("Average price = " . $avgPrice);
                        $this->logger->warning("Average price calculate= " . array_sum($data) / $soldAsset);
                    }

                    $asset->setPrice($avgPrice);
                    $asset->setChange($this->changesHelper->setChanges($asset, 'day'));
                    $asset->setWeeklyChange($this->changesHelper->setChanges($asset, 'week'));
                    $asset->setYearToDayChange($this->changesHelper->setChanges($asset, 'year'));
                    $this->em->persist($asset);
                    $this->push($asset, $avgPrice, array_sum($data));
                    $this->storeAvgPrice($ticker, $avgPrice, array_sum($data));
                }
            }
        }
        $this->cassandra->close();
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
            'INSERT INTO svandis_asset_prices.average_price (ticker, price, volume, time) 
                        VALUES (?, ?, ?, toUnixTimestamp(now()));'
        );
        $batch = new BatchStatement(\Cassandra::BATCH_LOGGED);

        $batch->add($prepared, [
            'ticker' => $ticker,
            'price' =>  new \Cassandra\Float($avgPrice),
            'volume' =>  new \Cassandra\Float($volume),
        ]);

        $this->cassandra->execute($batch);
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
