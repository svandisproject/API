<?php


namespace Kami\StockBundle\Watcher\Bittrex\Utils;



interface ClientInterface
{

    const API_URL = 'https://bittrex.com/api/v1.1/public/';

    /**
     * Retrieve all markets
     *
     * @return array
     */
    public function getMarkets();

    /**
     * Get ticker
     *
     * @return array
     */
    public function getTickers();

}