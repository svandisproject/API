<?php


namespace Kami\StockBundle\Model;


interface StorableInterface
{
    public function toDatabaseValues() : array;
}