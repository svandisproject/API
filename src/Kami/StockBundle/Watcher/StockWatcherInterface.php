<?php


namespace Kami\StockBundle\Watcher;


interface StockWatcherInterface
{
    /**
     * Returns graph points to store
     *
     * @return array<Point>
     */
    public function tick() : array;
}