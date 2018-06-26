<?php


namespace Kami\StockBundle\Watcher;


interface ExchangeWatcherInterface
{

    /**
     * Return the price of pairs of assets reduced to the value in dollars
     *
     */
    public function updateAssetPrices();


    /**
     * Find or create asset in DB by ticker
     * @param array $tickerData
     *
     */
    public function findOrCreateAsset($tickerData);


}