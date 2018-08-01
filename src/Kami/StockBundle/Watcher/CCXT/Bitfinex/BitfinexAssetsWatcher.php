<?php


namespace Kami\StockBundle\Watcher\CCXT\Bitfinex;


use ccxt\bitfinex;
use ccxt\ExchangeError;
use ccxt\NetworkError;
use Kami\StockBundle\Watcher\AbstractExchangeWatcher;

class BitfinexAssetsWatcher extends AbstractExchangeWatcher
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
     * @return void
     */
    public function updateAssetPrices()
    {

        $bitfinexExchange = new bitfinex();

        try {
            $bitfinexTickers = $bitfinexExchange->fetch_tickers();

        } catch (NetworkError $e) {
            $this->logger->error('[Network Error] ' . $e->getMessage ());
        } catch (ExchangeError $e) {
            $this->logger->error('[Exchange Error] ' . $e->getMessage ());
        } catch (\Exception $e) {
            $this->logger->error('[Error] ' . $e->getMessage ());
        }

        if ($bitfinexTickers) {
            $this->setUniquePresentedCurrencies($bitfinexTickers);
            $this->getUsdPrices($bitfinexTickers);
            foreach ($this->tickersArray as $tickerData) {
                $point = $this->createNewPoint($tickerData);
                $this->persistPoint($point, 'Bitfinex');
            }
        }

    }

    /**
     * @param array $bitfinexTickers
     *
     * @return void
     */
    public function getUsdPrices(array $bitfinexTickers)
    {

        foreach ($this->presentedCurrencies as $presentedCurrency){
            $price = null;
            foreach ($bitfinexTickers as $tickerData){
                if($tickerData['info']['pair'] == $presentedCurrency.'USD'){
                    $price = $tickerData['last'];
                }
            }
            array_push($this->tickersArray, ['asset' => $presentedCurrency, 'price' => floatval($price)]);
        }
    }

    /**
     * @param array $assetsArray
     * @return void
     */
    private function setUniquePresentedCurrencies(array $assetsArray)
    {
        foreach ($assetsArray as $data){
                $ticker = $data['info']['pair'];
                $presentedCurrency = substr($ticker, 0, -3);
                if(!in_array($presentedCurrency, $this->presentedCurrencies)){
                    array_push($this->presentedCurrencies, $presentedCurrency);
                }
        }
    }

}