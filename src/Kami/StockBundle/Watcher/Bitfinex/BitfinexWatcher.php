<?php


namespace Kami\StockBundle\Watcher\Bitfinex;


use Cassandra\BatchStatement;
use Cassandra\Uuid;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Kami\AssetBundle\Entity\Asset;
use Kami\StockBundle\Model\Point;
use Kami\StockBundle\Watcher\AbstractExchangeWatcher;

class BitfinexWatcher extends AbstractExchangeWatcher
{
    /**
     * @var array
     */
    private $presentedCurrencies = [];

    /**
     * @var array
     */
    private $tickersArray = [];

    /**
     * @throws ORMInvalidArgumentException
     * @throws ORMException
     * @throws \Cassandra\Exception
     * @return void
     */
    public function updateAssetPrices()
    {
        $body = file_get_contents('https://api.bitfinex.com/v2/tickers?symbols=ALL');
        $data = json_decode($body);
        $this->setUniquePresentedCurrencies($data);
        $this->getUsdPrices($data);

        foreach ($this->tickersArray as $tickerData){
            $point = $this->createNewPoint($tickerData);

            $this->persistPoint($point);
        }
    }

    /**
     * @param array $data
     * @return void
     */
    public function getUsdPrices(array $data)
    {
        foreach ($this->presentedCurrencies as $presentedCurrency){
            $price = null;
            foreach ($data as $datum){
                if($datum[0] == 't'.$presentedCurrency.'USD'){
                    $price = $datum[7];
                }
            }
            array_push($this->tickersArray, ['asset' => $presentedCurrency, 'price' => floatval($price)]);
        }
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
        $asset->setPrice($tickerData['price']);
        $asset->setTicker($tickerData['asset']);
        $this->entityManager->persist($asset);
        $this->entityManager->flush();

        return $asset;
    }

    /**
     * @param array $tickerData
     * @throws ORMInvalidArgumentException
     * @throws ORMException
     * @return Point
     */
    public function createNewPoint(array $tickerData) :Point
    {
        $asset = $this->findOrCreateAsset($tickerData);
        $point = new Point($asset, new \DateTime(), $tickerData['price']);

        return $point;
    }

    /**
     * @param array $data
     * @return void
     */
    private function setUniquePresentedCurrencies(array $data)
    {
        foreach ($data as $datum){
            //$datum = 'tBTCUSD'
            if($datum[0][0] == 't'){
                $ticker = trim($datum[0], 't');//'BTCUSD'
                $presentedCurrency = substr($ticker, 0, -3);//'BTC'
                if(!in_array($presentedCurrency, $this->presentedCurrencies)){
                    array_push($this->presentedCurrencies, $presentedCurrency);
                }
            }
        }
    }

}