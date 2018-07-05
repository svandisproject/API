<?php


namespace Kami\StockBundle\Watcher\Bitfinex;

use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use GuzzleHttp\Client;
use Kami\StockBundle\Watcher\AbstractExchangeWatcher;

class BitfinexWatcher extends AbstractExchangeWatcher
{
    /**
     * @var array
     */
    private $presentedCurrencies = [];

    /**
     * @var array
     */
    private $tickersArray = [];

    /**
     * @throws ORMInvalidArgumentException
     * @throws ORMException
     * @throws \Cassandra\Exception
     * @return void
     */
    public function updateAssetPrices()
    {
        $guzzle = new Client();
        try {
            $body = $guzzle->get('https://api.bitfinex.com/v2/tickers?symbols=ALL')->getBody();
            $data = json_decode($body);
            $this->setUniquePresentedCurrencies($data);
            $this->getUsdPrices($data);

            foreach ($this->tickersArray as $tickerData){
                $point = $this->createNewPoint($tickerData);

                $this->persistPoint($point);
            }
        } catch (\Exception $exception) {
            $this->logger->error('Couldn\'t update Bitfiniex prices');
        }

    }

    /**
     * @param array $data
     * @return void
     */
    public function getUsdPrices(array $data)
    {
        foreach ($this->presentedCurrencies as $presentedCurrency){
            $price = null;
            foreach ($data as $datum){
                if($datum[0] == 't'.$presentedCurrency.'USD'){
                    $price = $datum[7];
                }
            }
            array_push($this->tickersArray, ['asset' => $presentedCurrency, 'price' => floatval($price)]);
        }
    }

    /**
     * @param array $data
     * @return void
     */
    private function setUniquePresentedCurrencies(array $data)
    {
        foreach ($data as $datum){
            if($datum[0][0] == 't'){
                $ticker = trim($datum[0], 't');
                $presentedCurrency = substr($ticker, 0, -3);
                if(!in_array($presentedCurrency, $this->presentedCurrencies)){
                    array_push($this->presentedCurrencies, $presentedCurrency);
                }
            }
        }
    }

}