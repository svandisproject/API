<?php

namespace Kami\IcoBundle\Normalizer\IcoBench\Property;

use Kami\AssetBundle\Entity\Asset;
use Kami\IcoBundle\Entity\Finance;
use Kami\IcoBundle\Normalizer\PropertyNormalizerInterface;
use Doctrine\ORM\EntityManager;
use GuzzleHttp\Client;
use SimpleXMLElement;

class FinanceNormalizer implements PropertyNormalizerInterface
{

    private $httpClient;

    private $em;

    private $ethPrice = 0;

    private $asset;

    /**
     * FinanceNormalizer constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->httpClient = new Client();
        $this->em = $em;
    }


    /**
     * @param $remoteData
     * @param $ico
     * @return Finance
     */
    public function normalize($remoteData, $ico): Finance
    {
        if (!$finance = $ico->getFinance()) {
            $finance = new Finance();
        }
        if (!empty($remoteData)) {
            $this->asset = $this->getAsset($remoteData['token']);
            $this->ethPrice = $this->getEthPriceGlobal();

            if ($remoteData['price']) {
                $this->setAssetPrice($remoteData);
                $finance->setTokenPriceEth( $this->getEthPrice($remoteData));
            }
            if ($remoteData['hardcap']) {
                $finance->setHardCap($this->getUsdHardCap($remoteData));
                $finance->setHardCapEth($this->getEthHardCap($remoteData));
            }
            if ($remoteData['softcap']) {
                $finance->setMinCap($this->getUsdMinCap($remoteData));
            }
            if ($remoteData['tokens']) {
                $finance->setTotalSupply($remoteData['tokens']);
            }
            if ($remoteData['raised']) {
                $finance->setRaisedUsd($remoteData['raised']);
            }
            if ($remoteData['accepting']) {
                $finance->setAcceptedCurrency($this->addAcceptingCurrencies($remoteData['accepting']));
            }
            $finance->setIco($ico);
        }

        $this->em->persist($finance);
        return $finance;
    }

    private function addAcceptingCurrencies($value)
    {
        $normalizeArray = [];
            $peaces = explode(',', $value);
            foreach ($peaces as $peace) {
                $normalizeArray[] = trim($peace);
            }
        return $normalizeArray;
    }

    /** Get float price in USD from string in different currencies
     * @param $price
     * @return float
     */
    private function getUsdPrice($price)
    {
        $cost = floatval(str_replace(",", "", $price));
        $currency = trim(preg_replace('/[0-9]+/', '', $price), $character_mask = ". |, ");
        if ($currency == 'USD') {
            return $cost;
        } else {
            return $this->getPriceCurrencyInUsd($cost, $currency);
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
                    if (floatval($part0) == 1) {
                        return  $this->getUsdPrice($part1);
                    } else {
                        if (floatval($part0) != 0) {
                            return $this->getUsdPrice($part1) / floatval($part0);
                        } else return 0;
                    }
                } elseif(strpos($part1, $token)) {
                    return $this->getUsdPrice($part0) / floatval($part1);
                }
            } return 0;
        }
        return 0;
    }

    /**
     * @param float $priceInCurrency
     * @param string $currency
     * @return mixed
     */
    private function getPriceCurrencyInUsd($priceInCurrency, $currency)
    {
        $fiat = ['EUR', 'GBP'];
        if (in_array($currency, $fiat)) {
            return $priceInCurrency * $this->getFiatUsdPrice()[$currency.'USD'];
        } else {
            return $priceInCurrency * $this->getPriceFromAsset($currency);
        }
    }

    /**
     * @return mixed
     */
    private function getFiatUsdPrice()
    {
        $fiatPairs = ['EURUSD', 'GBPUSD'];
        $body = $this->httpClient->get('https://rates.fxcm.com/RatesXML')->getBody()->getContents();
        $xml = new SimpleXMLElement($body);
        $normalizeArray = [];
        foreach ($xml->children() as $rate){
            if(in_array($symbol = (string) $rate['Symbol'], $fiatPairs)){
                $averagePrice = (floatval($rate->Bid) + floatval($rate->Ask)) / 2;
                $normalizeArray[$symbol] =  $averagePrice;
            }
        }
        return $normalizeArray;
    }

    /**
     * @param $ticker
     * @return int|float
     */
    private function getPriceFromAsset($ticker)
    {
        if($asset = $this->em->getRepository('KamiAssetBundle:Asset')->findOneBy(['ticker' => $ticker])){
            if($price = $asset->getPrice()){
                return $price;
            }
        }
        return 0;
    }

    /**
     * @param $remoteData
     * @return bool
     */
    private function setAssetPrice($remoteData)
    {
        if ($this->asset) {
            if (!$this->asset->getPrice()) {
                $this->asset->setPrice($this->getPrice($remoteData));
                $this->em->persist($this->asset);
            }
        }
        return true;
    }

    /**
     * @param array $remoteData
     * @return float|int
     */
    private function getEthPrice ($remoteData)
    {
        if (strripos($remoteData['price'], "=") !== false) {
            $parts = explode('=', str_replace(',','.',$remoteData['price']));
            $part0 = trim($parts[0]);
            $part1 = trim($parts[1]);

            if (strpos($part1, 'ETH')) {;
                return floatval($part1);
            } elseif (strpos($part0, 'ETH')) {
                return floatval($part0)/floatval($part1);
            } else {
                if ($this->asset) {
                    $price = $this->asset->getPrice();
                } else {
                    $price = $this->getPrice($remoteData);
                }
                return $price / $this->ethPrice;
            }
        } else return 0;
    }

    /**
     * @param array $remoteData
     * @return float|int
     */
    private function getUsdHardCap ($remoteData) {
            $preCost = str_replace(".", "", $remoteData['hardcap']);
            $cost = floatval(str_replace(",", "", $preCost));
            $currency = trim(preg_replace('/[0-9]+/', '', $remoteData['hardcap']), $character_mask = ". |, ");
            if ($currency == $remoteData['token']) {
                if ( $this->asset) {
                    if ($price = $this->asset->getPrice()) {
                        return $cost * $price;
                    }   else return 0;
                } else return 0;
            } elseif ($currency == "USD") {
                return $cost;
            } else return $this->getUsdPrice($remoteData['hardcap']);
        }

    /**
     * @param array $remoteData
     * @return float|int
     */
    private function getUsdMinCap ($remoteData) {
        $preCost = str_replace(".", "", $remoteData['softcap']);
        $cost = floatval(str_replace(",", "", $preCost));
        $currency = trim(preg_replace('/[0-9]+/', '', $remoteData['softcap']), $character_mask = ". |, ");
        if ($currency == $remoteData['token']) {
            if ( $this->asset) {
                if ($price = $this->asset->getPrice()) {
                    return $cost * $price;
                }   else return 0;
            } else return 0;
        } elseif ($currency == "USD") {
            return $cost;
        } else return $this->getUsdPrice($remoteData['softcap']);
    }

    /**
     * @param array $remoteData
     * @return float
     */
    private function getEthHardCap ($remoteData) {
        $preCost = str_replace(".", "", $remoteData['hardcap']);
        $cost = floatval(str_replace(",", "", $preCost));
        $currency = trim(preg_replace('/[0-9]+/', '', $remoteData['hardcap']), $character_mask = ". |, ");
        if ($currency == "ETH") {
            return $cost;
        } else return $this->getUsdHardCap($remoteData) / $this->ethPrice;
    }

    /**
     * @return mixed
     */
    private function getEthPriceGlobal ()
    {
        return ($this->em->getRepository(Asset::class)->findOneBy(['ticker'=>'ETH']))->getPrice();
    }

    /**
     * @param string $token
     * @return mixed
     */
    private function getAsset($token): ?Asset
    {
        return $this->em->getRepository(Asset::class)->findOneBy(['ticker'=> $token]);
    }

}