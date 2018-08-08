<?php


namespace Kami\StockBundle\Watcher\History;


use Cassandra\BatchStatement;
use Cassandra\Timeuuid;
use Cassandra\Uuid;
use Exception;

class AvailableExchangesHistoryWatcher extends AbstractHistoryExchangeWatcher
{

    /**
     * @var array
     */
    private $historyDataAsset = [];

    /**
     * @var array
     */
    private $availableExchanges = [
        'Bittrex',
        'Poloniex',
        'Bitfinex'
    ];

    public function syncHistory()
    {
        $assets = $this->getAssets();
        $this->getRemoteData($assets);
    }

    /**
     * @param array $assets
     */
    private function getRemoteData($assets)
    {
        foreach ($this->availableExchanges as $exchange) {

            foreach ($assets as $asset) {
                try {
                    $body = $this->httpClient
                        ->get('https://min-api.cryptocompare.com/data/histoday?fsym=' . $asset->getTicker() . '&tsym=USD&aggregate=1&limit=3000&e=' . $exchange)
                        ->getBody();
                    $data = (array) json_decode($body);
                    if ($data['Response'] === "Success") {
                        foreach ($data['Data'] as $remoteData) {

                            if ($remoteData->open != 0 && $remoteData->close != 0) {
                                array_push($this->historyDataAsset,  [
                                    'exchange' => $exchange,
                                    'ticker' => $asset->getTicker(),
                                    'time' => $remoteData->time,
                                    'price' => $remoteData->close
                                ]);
                            }
                        }
                    }
                } catch (\Exception $exception) {
                    $this->logger->error('Could\'t get remote history data for ' . $asset->getTicker() . ' from exchange ' . $exchange );
                }
            }
        }

        $this->persistHistoryPrices($this->historyDataAsset);
    }

    /**
     * @param array $remoteDataArray
     *
     * @return void
     */
    private function persistHistoryPrices($remoteDataArray): void
    {
        $cassandra = $this->client;
        foreach ($remoteDataArray as $remoteData) {
            try {
                $prepared = $cassandra->prepare(
                    'INSERT INTO svandis_asset_prices.asset_price (id, ticker, price, exchange, time)
                    VALUES (?, ?, ?, ?, toUnixTimestamp('.new Timeuuid(intval($remoteData['time']) * 1000).'));'
                );
                $batch = new BatchStatement(\Cassandra::BATCH_LOGGED);
                $batch->add(
                    $prepared,
                    [
                        'id' => new Uuid(\Ramsey\Uuid\Uuid::uuid1()->toString()),
                        'ticker' => $remoteData['ticker'],
                        'price' => new \Cassandra\Float($remoteData['price']),
                        'exchange' => $remoteData['exchange']
                    ]
                );
                $cassandra->execute($batch);
            } catch (Exception $e) {
                $this->logger->error('Could\'t persist this data to Cassandra');
            }
        }
    }
}