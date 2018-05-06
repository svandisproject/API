<?php


namespace Kami\IcoBundle\Normalizer;


use Kami\IcoBundle\Entity\Ico;

interface IcoNormalizerInterface
{
    /**
     * @param mixed
     */
    public function fromRemote(Ico $ico, array $remoteData);

    /**
     * @return mixed
     */
    public function getPropertyMap();
}