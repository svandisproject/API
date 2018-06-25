
namespace Kami\StockBundle\Binance;


use Binance\API;
use Cassandra\BatchStatement;
use Doctrine\ORM\EntityManager;
use Kami\AssetBundle\Entity\Asset;
use M6Web\Bundle\CassandraBundle\Cassandra\Client;
use Cassandra\Uuid;

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
        $points = [];
        foreach ($ticker as $pair => $price) {
            $points[] = $this->getUsdPrice($ticker, $pair, $price);
        }

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

    private function getUsdPrice($ticker, $pair, $price)
    {
        $tickerPair = ['USDT', 'BTC', 'ETH', 'BNB'];
        
        foreach ($tickerPair as $currency) {
            if (strpos($pair, $currency) >= 1) {
                $asset = strstr ($pair, $currency, true);
                if ($currency == 'USDT') {
                    $rate = $price;
                } else {
                    $rate = $ticker[$currency . 'USDT'] * $price;
                }
            }
        }

        return [
            'asset' => $asset,
            'price' => $rate
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
            $this->entityManager->flush();
        }
        return $asset;
    }
} 