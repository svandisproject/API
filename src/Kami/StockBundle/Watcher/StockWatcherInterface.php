<?php


namespace Kami\StockBundle\Watcher;

interface StockWatcherInterface
{
    /**
     * Return the price of pairs of assets reduced to the value in dollars     *
     *
     */
    public function getAssetPrices();

    /**
     * Find or create asset in DB by ticker
     * @param array $point
     *
     */
    public function findOrCreateAsset($point);

    /**
     * Returns graph points to store
     *
     * @return array<Point>
     */
    public function tick() : array;
}