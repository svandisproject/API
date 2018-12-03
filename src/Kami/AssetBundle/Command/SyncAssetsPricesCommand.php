<?php


namespace Kami\AssetBundle\Command;

use Cassandra\Exception\ExecutionException;
use Cassandra\SimpleStatement;
use Doctrine\ORM\EntityManager;
use Kami\AssetBundle\Entity\TradableToken;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use M6Web\Bundle\CassandraBundle\Cassandra\Client;


class SyncAssetsPricesCommand extends Command
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var Client
     */
    private $client;

    public function __construct(EntityManager $entityManager, Client $client){

        $this->entityManager = $entityManager;
        $this->client = $client;

       parent::__construct();
    }

    public function configure()
    {
        $this->setName('svandis:assets_prices:sync');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \Cassandra\Exception
     * @throws \Exception
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $assets = $this->entityManager->getRepository(TradableToken::class)->findAll();
        $assets = $this->entityManager->getRepository(TradableToken::class)->findByTicker('ADA');

        foreach ($assets as $asset) {
            $preparedTicker = strtolower(trim($asset->getTicker()));
                try {
                    $query = "SELECT COUNT(*), volume, price, time FROM svandis_asset_prices.avg_price_" .
                        $preparedTicker . " WHERE ticker = '$preparedTicker' ORDER BY time ASC LIMIT 3000000 ALLOW FILTERING";
                    $statement = new SimpleStatement($query);
                    $result = $this->client->execute($statement);
                    try {
                        $points = [];
                        foreach ($result as $row) {
                            array_push($points, [
                                "price" => $row['price']->value(),
                                "volume" => $row['volume']->value(),
                                "time" => $row['time']->time()
                            ]);
                            $output->writeln($row['count']->value());
                        }
                        file_put_contents(__DIR__ . '/../Points/' . $preparedTicker . '.json', json_encode($points));
                    } catch (\Exception $exception) {
                        $output->writeln($exception->getMessage());
                    }

                } catch (ExecutionException $exception) {
                    $output->writeln($exception->getMessage());
                }
        }

        $output->writeln("DONE");
    }
}