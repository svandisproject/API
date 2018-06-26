<?php

namespace Kami\StockBundle\Binance;


use Binance\API;
use Cassandra\BatchStatement;
use Doctrine\ORM\EntityManager;
use Kami\AssetBundle\Entity\Asset;
use M6Web\Bundle\CassandraBundle\Cassandra\Client;
use Symfony\Component\Validator\Constraints\Uuid;

class BinanceSync
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
     * AbstractPropertyNormalizer constructor.
     * @param EntityManager $manager
     */
    public function __construct(EntityManager $manager, Client $client)
    {
        $this->entityManager = $manager;
        $this->client = $client;
    }

    public function execute()
    {
        $api = new API();
        $ticker = $api->prices();

        foreach ($ticker as $pair => $price) {
            $points[] = $this->getUsdPrice($ticker, $pair, $price);
        }

        $cassandra = $this->client;
        $prepared = $cassandra->prepare("INSERT INTO svandis_asset_prices.asset_price(id, update_time, ticker, price) VALUES(?, ?, ?, ?)");
        $batch = new BatchStatement(\Cassandra::BATCH_LOGGED);
        foreach ($points as $point){
            $this->findOrCreateAsset($point);
            $batch->add($prepared, [
                'id' => new Uuid(),
                'updated_time' => new \DateTime(),
                'asset' => $point['asset'],
                'price' => $point['price']
            ]);
        }

        $cassandra->execute($batch);



        dump($cassandra);die;
    }

    private function getUsdPrice($ticker, $pair, $price)
    {
        $tickerPair = ['USDT', 'BTC', 'ETH', 'BNB'];

        foreach ($tickerPair as $currency) {
            if (strpos($pair, $currency) >= 1) {
                $asset = strstr ($pair, $currency, true);
                if ($currency == 'USDT') {
                    $cource = $price;
                } else {
                    $cource = $ticker[$currency . 'USDT'] * $price;
                }
            }
        }

        return [
            'asset' => $asset,
            'price' => $cource
        ];
    }

    private function findOrCreateAsset($point) : Asset
    {
        $asset = $this->entityManager->getRepository(Asset::class)->findOneBy(['ticker' => $point['asset']]);
        if (!$asset) {
            $asset = new Asset();
            $asset->setPrice($point['price']);
            $asset->setTicker($point['asset']);
            $this->entityManager->persist($asset);
        }
        return $asset;
    }
}