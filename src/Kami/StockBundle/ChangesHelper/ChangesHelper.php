<?php

namespace Kami\StockBundle\ChangesHelper;

use Cassandra\SimpleStatement;
use Kami\AssetBundle\Entity\Asset;
use M6Web\Bundle\CassandraBundle\Cassandra\Client as CassandraClient;

class ChangesHelper
{
    /**
     * @var CassandraClient
     */
    private $client;

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

    public function __construct(CassandraClient $client)
    {
        $this->client = $client;

        $this->endOfLastYear = (new \DateTime('@'.strtotime(date('Y') - 1 . '-12-31 23:55')))
            ->format('Y-m-d H:i:s');
        $this->startOfCurrentYear = (new \DateTime('@'.strtotime(date('Y') . '-01-01 00:00')))
            ->format('Y-m-d H:i:s');
        $this->endOfLastWeek = (new \DateTime('@'.strtotime(date("Y-m-d",strtotime("last sunday")) . ' 23:55')))
            ->format('Y-m-d H:i:s');
        $this->startOfCurrentWeek = (new \DateTime('@'.strtotime(date("Y-m-d",strtotime("last Monday", strtotime('tomorrow'))) . ' 00:00')))
            ->format('Y-m-d H:i:s');
        $this->yesterday = (new \DateTime('@'.strtotime(date("Y-m-d", time() - 60 * 60 * 24) . ' 23:55')))
            ->format('Y-m-d H:i:s');
        $this->today = (new \DateTime('@'.strtotime(date("Y-m-d", time()) . ' 00:00')))
            ->format('Y-m-d H:i:s');
    }

    /**
     * @param Asset $asset
     * @param string $period
     * @return null|string
     * @throws \Cassandra\Exception
     */
    public function setChanges($asset,$period)
    {
        switch ($period){
            case 'day':
                $from = $this->yesterday;
                $to = $this->today;
                break;
            case 'week':
                $from = $this->endOfLastWeek;
                $to = $this->startOfCurrentWeek;
                break;
            case 'year':
                $from = $this->endOfLastYear;
                $to = $this->startOfCurrentYear;
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
            return $this->getChange($asset->getPrice(), $result[0]['price']->value());
        } else {
            return null;
        }
    }

    private function getChange($price, $lastPrice)
    {
        if($price > $lastPrice){
            $result = ((($price * 100) / $lastPrice) - 100);
        } else {
            $result = - ((($lastPrice * 100) / $price) - 100);
        }

        return $result;
    }
}