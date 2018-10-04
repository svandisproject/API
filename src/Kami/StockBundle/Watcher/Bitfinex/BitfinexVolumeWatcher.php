<?php


namespace Kami\StockBundle\Watcher\Bitfinex;

use function dump;
use GuzzleHttp\Client;
use Kami\StockBundle\Watcher\AbstractVolumesWatcher;
use SimpleXMLElement;
use function sleep;

class BitfinexVolumeWatcher extends AbstractVolumesWatcher
{

    /**
     * @var array
     */
    private $synonyms = [
        'SEE' => 'SEER',
        'DSH' => 'DASH',
        'QTM' => 'QTUM',
        'IOT' => 'IOTA',
        'IOS' => 'IOST',
        'MIT' => 'MITH'
    ];

    public function updateVolumes()
    {
        $guzzle = new Client();
        $body = $guzzle->get('https://api.bitfinex.com/v2/tickers?symbols=ALL')->getBody();
        $data = json_decode($body);

        $normalizeArray = $this->dataNormalize($data);
        $usdValues = $this->getUsdValues($normalizeArray);

        foreach ($usdValues as $assetKey => $usdVolume) {

            if (array_key_exists($assetKey, $this->synonyms)) {
                $assetKey = $this->synonyms[$assetKey];
            }

            $asset = $this->findOrCreateAsset($assetKey);
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
        foreach ($data as $datum){
            if($datum[0][0] == 't'){
                $normalizeArray[trim($datum[0], 't')] = [
                    'price' => ($datum[9] + $datum[10]) / 2,
                    'volume' => $datum[8],
                ];
            }
        }
        return $normalizeArray;
    }



}