<?php

namespace Kami\StockBundle\ChangesHelper;

use Cassandra\SimpleStatement;
use Doctrine\ORM\EntityManager;
use function dump;
use Kami\AssetBundle\Entity\Asset;
use M6Web\Bundle\CassandraBundle\Cassandra\Client as CassandraClient;

class ChangesHelper
{
    /**
     * @var CassandraClient
     */
    private $client;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var \DateTime
     */
    private $startOfCurrentYear;

    /**
     * @var \DateTime
     */
    private $startOfCurrentWeek;

    /**
     * @var \DateTime
     */
    private $today;

    public function __construct(CassandraClient $client, EntityManager $em)
    {
        $this->client = $client;
        $this->em = $em;

        $this->startOfCurrentYear = (new \DateTime(date('Y') . '-01-01 00:00'))
            ->format('Y-m-d H:i:s');
        $this->startOfCurrentWeek = (new \DateTime())
            ->setTimestamp(strtotime("last Monday", strtotime('tomorrow')))
            ->format('Y-m-d H:i:s');
        $this->today = (new \DateTime('today midnight'))
            ->format('Y-m-d H:i:s');
    }

    /**
     * @param Asset $asset
     * @param string $period
     * @return float|int
     * @throws \Cassandra\Exception
     */
    public function setChanges(Asset $asset, string $period)
    {
        switch ($period){
            case 'day':
                $to = $this->today;
                break;
            case 'week':
                $to = $this->startOfCurrentWeek;
                break;
            case 'year':
                $to = $this->startOfCurrentYear;
                break;
        }

        $ticker = $asset->getTicker();
        $preparedTicker = strtolower(str_replace(" ", "_", trim($ticker)));
        $cassandra = $this->client;
        $query = "SELECT volume, price, time ".
            "from svandis_asset_prices.avg_price_" . $preparedTicker . " WHERE ticker = '$preparedTicker'" .
            " AND time < '$to' ORDER BY time DESC LIMIT 1 ALLOW FILTERING";
        $statement = new SimpleStatement($query);
        $result = $cassandra->execute($statement);
        if ($result[0]['price'] != null) {
            return $this->getChange($asset, $result[0]['price']->value());
        }

        return 0;
    }

    /**
     * @param Asset $asset
     * @param float $lastPrice
     * @return float|int
     */
    private function getChange(Asset $asset, float $lastPrice)
    {
        $price = $asset->getPrice();
        if($price > $lastPrice){
            $result = ((($price * 100) / $lastPrice) - 100);
        } else {
            if ($price != 0) {
                $result = - ((($lastPrice * 100) / $price) - 100);
            } else $result = 0;
        }

        return $result;
    }
}