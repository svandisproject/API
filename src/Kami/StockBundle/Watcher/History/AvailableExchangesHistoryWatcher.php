<?php


namespace Kami\StockBundle\Watcher\History;


use Cassandra\BatchStatement;
use Cassandra\Timeuuid;
use Cassandra\Uuid;
use Exception;
use Psr\Http\Message\ResponseInterface;

class AvailableExchangesHistoryWatcher extends AbstractHistoryExchangeWatcher
{

    /**
     * @var array
     */
    private $historyDataAsset = [];

    /**
     * @var string
     */
    private $selfTicker;

    /**
     * @var string
     */
    private $selfExchange;

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
                        $this->selfTicker = $asset->getTicker();
                        $this->selfExchange = $exchange;
                    $promise = $this->httpClient->getAsync(
                        'https://min-api.cryptocompare.com/data/histoday?fsym=' . $asset->getTicker() . '&tsym=USD&aggregate=1&limit=3000&e=' . $exchange);
                    $promise->then(
                        function (ResponseInterface $res) {
                            $data = json_decode($res->getBody(), true);
                            if ($data['Response'] === "Success") {
                                foreach ($data['Data'] as $remoteData) {
                                    if ($remoteData['open'] != 0 && $remoteData['close'] != 0) {
                                        array_push($this->historyDataAsset,  [
                                            'exchange' => $this->selfExchange,
                                            'ticker' => $this->selfTicker,
                                            'time' => $remoteData['time'],
                                            'price' => $remoteData['close']
                                        ]);
                                    }
                                }
                            }
                        }
                    );
                    $promise->wait();
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
        foreach ($remoteDataArray as $remoteData) {
            try {
                $prepared = $this->client->prepare(
                    'INSERT INTO svandis_asset_prices.asset_price (id, ticker, price, exchange, time)
                    VALUES (?, ?, ?, ?, toUnixTimestamp('.new Timeuuid(intval($remoteData['time']) * 1000).'));'
                );
                $batch = new BatchStatement(\Cassandra::BATCH_LOGGED);
                $batch->add(
                    $prepared,
                    [
                        'id' => new Uuid(\Ramsey\Uuid\Uuid::uuid1()->toString()),
                        'ticker' => $remoteData['ticker'],
                        'price' => new \Cassandra\Float(floatval($remoteData['price'])),
                        'exchange' => $remoteData['exchange']
                    ]
                );
                $this->client->execute($batch);
            } catch (Exception $e) {
                $this->logger->error('Could\'t persist this data to Cassandra');
            }
        }
    }
}