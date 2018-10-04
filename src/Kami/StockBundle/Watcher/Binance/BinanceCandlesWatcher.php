<?php


namespace Kami\StockBundle\Watcher\Binance;

use Binance\API;
use Kami\StockBundle\AbstractCandlesWatcher;

class BinanceCandlesWatcher extends AbstractCandlesWatcher
{

    /**
     * @var array
     */
    private $convertableTickers = ['USDT', 'BTC', 'ETH', 'BNB'];

    /**
     * @var array
     */
    private $synonyms = [
        'BCC' => 'BCH',
        'BQX' => 'ETHOS'
    ];

    public function updateAssetCandles()
    {
        $binanceApi = new API();
        $prices = $binanceApi->prices();
        foreach ($prices as $pair => $price) {
            $dataCandles[$pair][] = $binanceApi->candlesticks($pair, '1m', 1);
        }
        $tickers = $this->getTickersFromPair($prices);
        $normalizeData = $this->normalizeTickersData($tickers, $dataCandles);
        $this->findOrCreatePair($normalizeData, 'Binance');
        $this->persistCandles($normalizeData, 'Binance');
    }

    private function getTickersFromPair($data)
    {
        $tickers = [];
        foreach ($data as $pair => $datum) {
            foreach ($this->convertableTickers as $currency) {
                if (strpos($pair, $currency) >= 1) {
                    $ticker = strstr($pair, $currency, true);
                    if (!in_array($ticker, $tickers)) {
                        $tickers[]= $ticker;
                    }
                }
            }
        }
        return $tickers;
    }

    private function normalizeTickersData ($tickers, $data)
    {
        $exchangeData= [];
        foreach ($tickers as $ticker) {
            foreach ($data as $pair => $datum) {
                // check if pair consist our ticker and exclude the possibility to isolate the ticker from the middle of the pair line
                if (strpos($pair, $ticker) !== false && in_array(str_replace($ticker, '', $pair), $this->convertableTickers)) {
                    // if the ticker has a synonym we replace it and in a pair
                    if (array_key_exists($ticker, $this->synonyms)) {
                        $pair = str_replace($ticker, $this->synonyms[$ticker], $pair);
                        $ticker = $this->synonyms[$ticker];
                    }
                    $exchangeData[$ticker][$pair][] = $datum;
                }
            }
        }
        return $exchangeData;
    }

}