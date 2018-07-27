<?php

namespace Kami\IcoBundle\Normalizer\IcoBench\Property;

use Doctrine\ORM\EntityManager;
use function dump;
use GuzzleHttp\Client;
use Kami\IcoBundle\Normalizer\PropertyNormalizerInterface;
use SimpleXMLElement;

class UsdPriceNormalizer implements PropertyNormalizerInterface
{

    private $httpClient;

    private $em;

    public function __construct(EntityManager $em)
    {
        $this->httpClient = new Client();
        $this->em = $em;
    }

    public function normalize($remoteData)
    {
        if ($price = $this->getPriceFromAsset($remoteData['token'])) {
            dump("FROM ASSETS " .$price);
            return $price;
        } else {
            dump("From calculate " . $this->getPrice($remoteData));
            return $this->getPrice($remoteData);
        }
    }

    private function getPrice($data) {
        if ($data['token'] && $data['price']) {
            $token = $data['token'];
            $parts = explode('=', str_replace(',','.',$data['price']));
            if (isset($parts[0]) && isset($parts[1])) {
                $part0 = trim($parts[0]);
                $part1 = trim($parts[1]);
            } else return 0;
            if (isset($part1)) {
                if (strpos($part0, $token)) {
                    return  $this->getUsdPrice($part1);
                } elseif(strpos($part1, $token)) {
                    return $this->getUsdPrice($part0) / floatval($part1);
                }
            } return 0;
        }
        return 0;
    }

    private function getUsdPrice($price)
    {
        $cost = floatval($price);
        $currency = trim(substr(strstr($price, (string) $cost), strlen((string) $cost)));

        if ($currency == 'USD') {
            return $cost;
        } else {
            return $this->getPriceCurrencyInUsd($cost, $currency);
        }
    }

    private function getPriceCurrencyInUsd($priceInCurrency, $currency)
    {
        $fiat = ['EUR', 'GBP'];

        if (in_array($currency, $fiat)) {
            return $priceInCurrency * $this->getFiatUsdPrice()[$currency.'USD'];
        } else {
            return $priceInCurrency * $this->getPriceFromAsset($currency);
        }
    }

    private function getFiatUsdPrice()
    {
        $fiatPairs = ['EURUSD', 'GBPUSD'];
        $body = $this->httpClient->get('https://rates.fxcm.com/RatesXML')->getBody()->getContents();
        $xml = new SimpleXMLElement($body);

        foreach ($xml->children() as $rate){
            if(in_array($symbol = (string) $rate['Symbol'], $fiatPairs)){
                $averagePrice = (floatval($rate->Bid) + floatval($rate->Ask)) / 2;
                $normalizeArray[$symbol] =  $averagePrice;
            }
        }
        return $normalizeArray;
    }

    private function getPriceFromAsset($ticker)
    {
        if($asset = $this->em->getRepository('KamiAssetBundle:Asset')->findOneBy(['ticker' => $ticker])){
            if($price = $asset->getPrice()){
                return $price;
            }
        }
        return 0;

    }

}