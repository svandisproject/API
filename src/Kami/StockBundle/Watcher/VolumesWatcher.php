<?php

namespace Kami\StockBundle\Watcher;

use Cassandra\BatchStatement;
use Cassandra\SimpleStatement;
use Doctrine\ORM\EntityManager;
use Kami\AssetBundle\Entity\Asset;
use Predis\Client;
use M6Web\Bundle\CassandraBundle\Cassandra\Client as CassandraClient;

class VolumesWatcher
{

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
     * VolumesWatcher constructor.
     * @param EntityManager $em
     * @param Client $redis
     * @param CassandraClient $cassandra
     */
    function __construct(
        EntityManager $em,
        Client $redis,
        CassandraClient $cassandra
    )
    {
        $this->em = $em;
        $this->redis = $redis;
        $this->cassandra = $cassandra;
    }
    /**
     * @throws \Cassandra\Exception
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function getVolumes()
    {
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
            if($data = $this->redis->get($ticker))
            {
                $data = (array) json_decode($data);
                $soldAsset = 0;
                foreach ($data as $exhange => $volume){
                    $query = "SELECT id, exchange, price, ticker, max(time) FROM svandis_asset_prices.asset_price ".
                        "WHERE ticker = '$ticker' AND exchange = '$exhange' ALLOW FILTERING";
                    $statement = new SimpleStatement($query);
                    $result = $this->cassandra->execute($statement);
                    $soldAsset += $volume / $result[0]['price']->value();
                }
                $avgPrice = array_sum($data) / $soldAsset;
                $asset->setPrice($avgPrice);
                $this->em->persist($asset);
                $this->em->flush();
                $this->storeAvgPrice($ticker, $avgPrice, array_sum($data));
            }
        }
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
}