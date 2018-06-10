<?php

namespace Kami\IcoBundle\Normalizer;

use Kami\IcoBundle\Entity\Ico;

interface IcoNormalizerInterface
{
    /**
     * @param Ico $ico
     * @param mixed $remoteData
     * @return mixed
     */
    public function normalize(Ico $ico, $remoteData) : Ico;

    /**
     * @return array
     */
    public function getPropertyMap() : array;
}