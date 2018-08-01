<?php


namespace Kami\StockBundle\Watcher\CCXT\Bitfinex;

use ccxt\bitfinex;
use ccxt\ExchangeError;
use ccxt\NetworkError;
use Exception;
use Kami\StockBundle\Watcher\AbstractVolumesWatcher;
use GuzzleHttp\Client;
use SimpleXMLElement;

include_once dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))))).'/vendor/ccxt/ccxt/ccxt.php';

class BitfinexVolumesWatcher extends AbstractVolumesWatcher
{

    public function updateVolumes()
    {
        $bitfinexExchange = new bitfinex();

        try {
            $bitfinexTickers = $bitfinexExchange->fetch_tickers();

        } catch (NetworkError $e) {
            $this->logger->error( '[Network Error] Could\'t update bitfinex volumes' . $e->getMessage ());
        } catch (ExchangeError $e) {
            $this->logger->error( '[Exchange Error] Could\'t update bitfinex volumes' . $e->getMessage ());
        } catch (Exception $e) {
            $this->logger->error( '[Error] Could\'t update bitfinex volumes' . $e->getMessage ());
        }

        $normalizeArray = $this->dataNormalize($bitfinexTickers);
        $usdValues = $this->getUsdValues($normalizeArray);
        foreach ($usdValues as $assetKey => $usdVolume) {
            $asset = $this->findAsset($assetKey);
            $this->persistVolumes($asset, $usdVolume, 'Bitfinex');
        }
    }

    private function getUsdValues($normalizeArray)
    {
        $fiat = ['EUR', 'JPY', 'GBP'];
        $normalizeArray = array_merge($normalizeArray, $this->getFiatUsdPrice());

        $usdValuesArray = [];
        foreach ($normalizeArray as $pair => $value) {
            $asset = substr($pair, 0, -3);
            $currency = substr($pair, -3);
            if(!in_array($asset, $fiat)){
                $usdValuesArray[$asset] = isset($usdValuesArray[$asset]) ? $usdValuesArray[$asset] : 0;

                $usdValuesArray[$asset] += ($currency == 'USD') ?
                    ($value['price'] * $value['volume']) :
                    ($value['price'] * $value['volume'] * $normalizeArray[$currency.'USD']['price']);
            }

        }
        return $usdValuesArray;
    }

    private function getFiatUsdPrice(){

        $fiatPars = ['EURUSD', 'GBPUSD', 'USDJPY'];

        $client = new Client();
        $body = $client->get('https://rates.fxcm.com/RatesXML')->getBody()->getContents();
        $xml = new SimpleXMLElement($body);

        foreach ($xml->children() as $rate){
            if(in_array($symbol = (string) $rate['Symbol'], $fiatPars)){
                $averagePrice = (floatval($rate->Bid) + floatval($rate->Ask)) / 2;
                $symbol = ($symbol == 'USDJPY') ? 'JPYUSD' : $symbol;
                $normalizeArray[$symbol]['price'] = ($symbol != 'JPYUSD') ? $averagePrice : (1 / $averagePrice);
                $normalizeArray[$symbol]['volume'] = 1;
            }
        }
        return $normalizeArray;
    }

    private function dataNormalize($data)
    {
        $normalizeArray = [];

        foreach ($data as $pair => $tickersData){

            $normalPair = str_replace('USDT', 'USD', str_replace('/', '', $pair));

                $normalizeArray[$normalPair] = [
                    'price' => ($tickersData['info']['low'] + $tickersData['info']['high']) / 2,
                    'volume' => floatval($tickersData['info']['volume'])
                ];
        }
        return $normalizeArray;
    }

}