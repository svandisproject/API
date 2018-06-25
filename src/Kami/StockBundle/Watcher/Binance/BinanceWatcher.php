<?php


namespace Kami\StockBundle\Watcher\Binance;

use Binance\API;
use Cassandra\BatchStatement;
use Doctrine\ORM\EntityManager;
use Kami\AssetBundle\Entity\Asset;
use Kami\StockBundle\Watcher\StockWatcherInterface;
use M6Web\Bundle\CassandraBundle\Cassandra\Client;
use Cassandra\Uuid;

class BinanceWatcher implements StockWatcherInterface
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
    public function getAssetPrices()
    {
        $api = new API();
        $ticker = $api->prices();
        $points = $this->getUsdPrices($ticker);
        $this->storeCassandra($points);
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

    private function storeCassandra($points)
    {
        $cassandra = $this->client;
        $prepared = $cassandra->prepare(
            'INSERT INTO svandis_asset_prices.asset_price (id, ticker, price, time) 
              VALUES (?, ?, ?, toTimeStamp(toDate(now())));'
        );
        $batch = new BatchStatement(\Cassandra::BATCH_LOGGED);
        foreach ($points as $point){
            $this->findOrCreateAsset($point);
            $batch->add($prepared, [
                'id' => new Uuid(\Ramsey\Uuid\Uuid::uuid1()->toString()),
                'ticker' => $point['asset'],
                'price' =>  new \Cassandra\Float($point['price'])
            ]);
        }

        $cassandra->execute($batch);
    }

    public function findOrCreateAsset($point)
    {
        if (!$asset = $this->entityManager->getRepository(Asset::class)->findOneBy(['ticker' => $point['asset']])) {
            $asset = new Asset();
        }
        $asset->setPrice($point['price']);
        $asset->setTicker($point['asset']);
        $this->entityManager->persist($asset);
        $this->entityManager->flush();

        return $asset;
    }


    public function tick(): array
    {
        // TODO: Implement tick() method.
    }
}