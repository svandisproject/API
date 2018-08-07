<?php

namespace Kami\StockBundle\ChangesHelper;

use Cassandra\SimpleStatement;
use Predis\Client;
use Kami\AssetBundle\Entity\Asset;
use M6Web\Bundle\CassandraBundle\Cassandra\Client as CassandraClient;

class ChangesHelper
{
    /**
     * @var CassandraClient
     */
    private $client;

    /**
     * @var Client
     */
    public $redis;

    /**
     * @var \DateTime
     */
    private $endOfLastYear;

    /**
     * @var \DateTime
     */
    private $startOfCurrentYear;

    /**
     * @var \DateTime
     */
    private $endOfLastWeek;

    /**
     * @var \DateTime
     */
    private $startOfCurrentWeek;

    /**
     * @var \DateTime
     */
    private $yesterday;

    /**
     * @var \DateTime
     */
    private $today;

    public function __construct(CassandraClient $client, Client $redis)
    {
        $this->client = $client;
        $this->redis = $redis;

        $this->endOfLastYear = (new \DateTime(date('Y') - 1 . '-12-31 23:55'))
            ->format('Y-m-d H:i:s');
        $this->startOfCurrentYear = (new \DateTime(date('Y') . '-01-01 00:00'))
            ->format('Y-m-d H:i:s');
        $this->endOfLastWeek = (new \DateTime("last sunday 23:55"))
            ->format('Y-m-d H:i:s');
        $this->startOfCurrentWeek = (new \DateTime())
            ->setTimestamp(strtotime("last Monday", strtotime('tomorrow')))
            ->format('Y-m-d H:i:s');
        $this->yesterday = (new \DateTime('yesterday 23:55'))
            ->format('Y-m-d H:i:s');
        $this->today = (new \DateTime('now'))
            ->format('Y-m-d H:i:s');
    }

    /**
     * @param Asset $asset
     * @param string $period
     * @return null|string
     * @throws \Cassandra\Exception
     */
    public function setChanges(Asset $asset, string $period)
    {
        switch ($period){
            case 'day':
                $from = $this->yesterday;
                $to = $this->today;
                $change = 'change';
                break;
            case 'week':
                $from = $this->endOfLastWeek;
                $to = $this->startOfCurrentWeek;
                $change = 'weeklyChange';
                break;
            case 'year':
                $from = $this->endOfLastYear;
                $to = $this->startOfCurrentYear;
                $change = 'yearToDayChange';
                break;
        }

        $ticker = $asset->getTicker();
        $cassandra = $this->client;
        $query = "SELECT volume, price, ticker, max(time) ".
            "from svandis_asset_prices.average_price ".
            "WHERE ticker = '$ticker' AND ".
            "time > '$from' AND ".
            "time < '$to' ".
            "ALLOW FILTERING";
        $statement = new SimpleStatement($query);
        $result = $cassandra->execute($statement);

        if($result[0]['price'] != null){
            return $this->getChange($asset, $result[0]['price']->value(), $change);
        } else {
            $query = "SELECT volume, price, ticker, max(time) ".
                "from svandis_asset_prices.average_price ".
                "WHERE ticker = '$ticker' AND ".
                "time < '$to'".
                "ALLOW FILTERING";
            $statement = new SimpleStatement($query);
            $result = $cassandra->execute($statement);
            if ($result[0]['price'] != null) {
                return $this->getChange($asset, $result[0]['price']->value(), $change);
            }
            return 0;
        }
    }

    /**
     * @param Asset $asset
     * @param float $lastPrice
     * @param string $change
     * @return float|int
     */
    private function getChange(Asset $asset, float $lastPrice, string $change)
    {
        $price = $asset->getPrice();
        if($price > $lastPrice){
            $result = ((($price * 100) / $lastPrice) - 100);
        } else {
            if ($price != 0) {
                $result = - ((($lastPrice * 100) / $price) - 100);
            } else $result = 0;
        }

        $this->setRedisChanges($asset->getTicker(), $result, $change);
        return $result;
    }

    /**
     * @param string $ticker
     * @param float $result
     * @param string $change
     */
    public function setRedisChanges(string $ticker, float $result, string $change):void
    {
        $data = json_decode($this->redis->get($ticker));
        $data->$change = $result;
        $this->redis->set($ticker, json_encode($data));
    }
}