<?php


namespace Kami\StockBundle\Watcher\Bittrex\Utils;

use Symfony\Component\Config\Definition\Exception\Exception;

class BittrexClient implements ClientInterface
{

    private function query($options)
    {

        $ch = curl_init(self::API_URL.$options);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // run the query
        $res = curl_exec($ch);

        if ($res === false) throw new Exception('Curl error: '.curl_error($ch));

        $dec = json_decode($res, true);
        if (!$dec){
            throw new Exception('Invalid data: '.$res);
        }else{
            return $dec;
        }
    }

    /**
     * Get  tickers list from markets
     *
     * @return array
     */
    public function getTickers() :array
    {

        $tickersArray = [];

        $marketsArray = $this->getMarkets();

        foreach ($marketsArray as $market) {
            $data = $this->query('getticker?market=' . $market);
            array_push($tickersArray, [$market => $data['result']['Last']]);
        }

       return $tickersArray;
    }

    /*
     * Get markets list from Bittrex API
     *
     */
    public function getMarkets() :array
    {
        $marketsArray = [];
        $dataArray = $this->query('getmarkets');
        foreach ($dataArray['result'] as $market) {
            array_push($marketsArray, $market['MarketName']);
        }

        return $marketsArray;
    }

}