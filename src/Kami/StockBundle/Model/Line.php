<?php


namespace Kami\StockBundle\Model;


class Line
{
    /**
     * @var Point
     */
    private $startPoint;

    /**
     * @var Point
     */
    private $endPoint;

    public function __construct(Point $startPoint, Point $endPoint)
    {
        $this->startPoint = $startPoint;
        $this->endPoint = $endPoint;
    }

    /**
     * @return Point
     */
    public function getStartPoint(): Point
    {
        return $this->startPoint;
    }

    /**
     * @return Point
     */
    public function getEndPoint(): Point
    {
        return $this->endPoint;
    }


}