<?php


namespace Kami\StockBundle\Watcher\Binance;

use Binance\API;
use Cassandra\BatchStatement;
use DateTime;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Kami\AssetBundle\Entity\Asset;
use Kami\StockBundle\Model\Point;
use Kami\StockBundle\Watcher\AbstractExchangeWatcher;
use Cassandra\Uuid;

class BinanceWatcher extends AbstractExchangeWatcher
{
    /**
     * @var array
     */
    private $convertableTickers = ['USDT', 'BTC', 'ETH', 'BNB'];

    /**
     * @throws \Exception
     * @throws \Cassandra\Exception
     * @return void
     */
    public function updateAssetPrices()
    {
        $api = new API();

        $ticker = $api->prices();

        $tickersArray = $this->getUsdPrices($ticker);
        foreach ($tickersArray as $tickerData) {
            $point = $this->createNewPoint($tickerData);

            $this->persistPoint($point);
        }

    }

    /**
     * @param array $data
     * @return array
     */
    public function getUsdPrices(array $data) :array
    {
        $points = [];

        foreach ($data as $pair => $price) {

            foreach ($this->convertableTickers as $currency) {
                if (strpos($pair, $currency) >= 1) {
                    $asset = strstr($pair, $currency, true);

                    if ($currency == 'USDT') {
                        $rate = $price;
                    } else {
                        $rate = $data[$currency.'USDT'] * $price;
                    }
                    array_push($points, ['asset' => $asset, 'price' => floatval($rate)]);
                }
            }
        }
        return $points;
    }

    /**
     * @param Point $point
     * @throws \Cassandra\Exception
     * @return void
     */
    public function persistPoint(Point $point)
    {
        $cassandra = $this->client;
        $prepared = $cassandra->prepare(
            'INSERT INTO svandis_asset_prices.asset_price (id, ticker, price, time) 
              VALUES (?, ?, ?, toTimeStamp(toDate(now())));'
        );
        $batch = new BatchStatement(\Cassandra::BATCH_LOGGED);
        $pointDbValues = $point->toDatabaseValues();

        $batch->add($prepared, [
            'id' => new Uuid(\Ramsey\Uuid\Uuid::uuid1()->toString()),
            'ticker' => $pointDbValues['asset'],
            'price' =>  new \Cassandra\Float($pointDbValues['price'])
        ]);

        $cassandra->execute($batch);
    }

    /**
     * @param array $tickerData
     * @throws ORMInvalidArgumentException
     * @throws ORMException
     * @return Asset
     */
    public function findOrCreateAsset(array $tickerData) :Asset
    {
        if (!$asset = $this->entityManager->getRepository(Asset::class)->findOneBy(['ticker' => $tickerData['asset']])) {
            $asset = new Asset();
        }
        if(in_array($tickerData['asset'], $this->convertableTickers)) $asset->setConvertable(true);
        $asset->setPrice($tickerData['price']);
        $asset->setTicker($tickerData['asset']);
        $this->entityManager->persist($asset);
        $this->entityManager->flush();

        return $asset;
    }

    /**
     * @param array
     * @throws ORMInvalidArgumentException
     * @throws ORMException
     * @return Point
     */
    public function createNewPoint(array $tickerData) :Point
    {
        $asset = $this->findOrCreateAsset($tickerData);
        $point = new Point($asset, new DateTime(), $tickerData['price']);

        return $point;
    }

}