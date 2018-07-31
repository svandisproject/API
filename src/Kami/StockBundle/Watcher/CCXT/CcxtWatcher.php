<?php

namespace Kami\StockBundle\Watcher\CCXT;

use ccxt\binance;
use ccxt\poloniex;
use function dirname;
use function dump;
use Kami\StockBundle\Watcher\AbstractExchangeWatcher;

include '../../../../../vendor/ccxt/ccxt/ccxt.php';


class CcxtWatcher extends AbstractExchangeWatcher
{

    public function updateAssetPrices()
    {

        $pol = new poloniex();
        $exchange = new binance(array (
            'verbose' => true,
            'timeout' => 30000,
        ));

        try {

            $symbol = 'ETH/BTC';
            $result = $exchange->fetch_ticker ($symbol);

            var_dump ($result);

        } catch (\ccxt\NetworkError $e) {
            echo '[Network Error] ' . $e->getMessage () . "\n";
        } catch (\ccxt\ExchangeError $e) {
            echo '[Exchange Error] ' . $e->getMessage () . "\n";
        } catch (Exception $e) {
            echo '[Error] ' . $e->getMessage () . "\n";
        }
    }

    public function getUsdPrices(array $data)
    {
        // TODO: Implement getUsdPrices() method.
    }

}