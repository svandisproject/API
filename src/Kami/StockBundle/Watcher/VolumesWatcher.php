<?php


namespace Kami\StockBundle\Watcher;

use Cassandra\BatchStatement;
use Cassandra\Exception\ExecutionException;
use Cassandra\SimpleStatement;
use Doctrine\ORM\EntityManager;
use Kami\AssetBundle\Entity\Asset;
use Kami\AssetBundle\Entity\TradableToken;
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
                    foreach ($data as $exhange => $volume){
                        $query = "SELECT  exchange, price, time FROM svandis_asset_prices.price_" .
                            $preparedTicker . " WHERE exchange = '$exhange' ORDER BY time DESC LIMIT 1 ALLOW FILTERING";
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
                        $asset = $this->assetSetTradableToken($asset);
                        $this->em->persist($asset);
                        $this->push($asset, $avgPrice, array_sum($data));
                    }
                }
            }
        }
        $this->em->flush();

    }

    /**
     * @param Asset $asset
     * @return Asset
     */
    private function assetSetTradableToken(Asset $asset)
    {
        $token = $asset->getTradableToken() ?: new TradableToken();

        $token->setPrice(round($asset->getPrice(), 5));
        $token->setTicker($asset->getTicker());
        $token->setTitle($asset->getTitle());
        $token->setType($asset->getTokenType());
        $token->setChange(round($asset->getChange(), 5));
        $token->setWeeklyChange(round($asset->getWeeklyChange(), 5));
        $token->setYearToDayChange(round($asset->getYearToDayChange(), 5));

        if($marketCap = $asset->getMarketCap()){
            if($mCap = $marketCap->getMarketCap()){
                $token->setMarketCap($mCap);
            }
            if($vol24 = $marketCap->getVolume24()){
                $token->setVolume($vol24);//???
            }
            if($circSupply = $marketCap->getCirculatingSupply()){
                $token->setCirculatingSupply($circSupply);
            }
        }

        if($ico = $asset->getIco()){
            if($finance = $ico->getFinance()){
                if($raised = $finance->getRaisedUsd()){
                    $token->setIcoAmount($raised);//???
                }
                if($totalSupply = $finance->getTotalSupply()){
                    $token->setMaxSupply($totalSupply);//???
                }
            }
        }
//        $token->setAge();
//        $token->setAlgorithm();
//        $token->setAvgVolumeWeeks52();
//        $token->setDiscord();
//        $token->setFacebook();
//        $token->setMediumFollowers();
//        $token->setMedium();
//        $token->setTwitterFollowers();
//        $token->setTwitter();
//        $token->setTelegrammFollowers();
//        $token->setTelegramm();
//        $token->setSteemit();
//        $token->setRedditSubscriber();
//        $token->setReddit();
//        $token->setInitialPrice();
//        $token->setLastPrice();
//        $token->setVolumeDay();
//        $token->setSector();//Industry? string?
//        $token->setReturnOnIco();
//        $token->setPriceChangeSixMonth();
//        $token->setPriceChangePercent();
//        $token->setPriceChangeMonth();
//        $token->setPriceChangeHour();
//        $token->setPriceChangeDay();
        $asset->setTradableToken($token);

        return $asset;
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
        $this->updatePointsFile($ticker, $avgPrice, $volume);
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

    private function updatePointsFile($ticker, $avgPrice, $volume)
    {
        $filePath = __DIR__ . '/../../AssetBundle/Points/' . $ticker . '.json';
        if (file_exists($filePath)) {
            $file = fopen($filePath, "r+");
            fseek($file, filesize($filePath)-1);
            fwrite($file, ',{"price":' . $avgPrice . ',"volume":' . $volume . ',"time":' . time() . '}]');
            fclose($file);
        } else {
            file_put_contents ( $filePath, json_encode([
                ["price"=>$avgPrice,"volume"=>$volume,"time"=>time()]
            ]));
            chmod($filePath, 0664);
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
