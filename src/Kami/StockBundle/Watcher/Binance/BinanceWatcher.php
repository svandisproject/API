<?php


namespace Kami\StockBundle\Watcher\Binance;

use Binance\API;
use Cassandra\BatchStatement;
use DateTime;
use Doctrine\ORM\EntityManager;
use Kami\AssetBundle\Entity\Asset;
use Kami\StockBundle\Model\Point;
use Kami\StockBundle\Watcher\ExchangeWatcherInterface;
use M6Web\Bundle\CassandraBundle\Cassandra\Client;
use Cassandra\Uuid;

class BinanceWatcher implements ExchangeWatcherInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var Client
     */
    protected $client;

    /**
     *
     * @param Client $client
     * @param EntityManager $manager
     */
    public function __construct(Client $client, EntityManager $manager)
    {
        $this->entityManager = $manager;
        $this->client = $client;
    }

    /**
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

    private function getUsdPrices($ticker)
    {
        $points = [];

        foreach ($ticker as $pair => $price) {

            $tickerPair = ['USDT', 'BTC', 'ETH', 'BNB'];

            foreach ($tickerPair as $currency) {
                if (strpos($pair, $currency) >= 1) {
                    $asset = strstr($pair, $currency, true);

                    if ($currency == 'USDT') {
                        $rate = $price;
                    } else {
                        $rate = $ticker[$currency.'USDT'] * $price;
                    }
                    array_push($points, ['asset' => $asset, 'price' => floatval($rate)]);
                }
            }
        }
        return $points;
    }

    private function persistPoint(Point $point)
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
     * @return Asset|null|object
     */
    public function findOrCreateAsset($tickerData)
    {
        if (!$asset = $this->entityManager->getRepository(Asset::class)->findOneBy(['ticker' => $tickerData['asset']])) {
            $asset = new Asset();
        }
        $asset->setPrice($tickerData['price']);
        $asset->setTicker($tickerData['asset']);
        $this->entityManager->persist($asset);
        $this->entityManager->flush();

        return $asset;
    }

    /**
     * @param array
     *
     * @return Point
     */
    public function createNewPoint($tickerData) :Point
    {
        $asset = $this->findOrCreateAsset($tickerData);
        $point = new Point($asset, new DateTime(), $tickerData['price']);

        return $point;
    }

}