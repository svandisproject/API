<?php


namespace Kami\IcoBundle\Normalizer\IcoBench\Property;

use Kami\IcoBundle\Entity\Dates;
use Kami\IcoBundle\Entity\Ico;
use Kami\IcoBundle\Normalizer\PropertyNormalizerInterface;
use Doctrine\ORM\EntityManager;

class DatesNormalizer implements PropertyNormalizerInterface
{

    private $em;

    /**
     * DatesNormalizer constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param array $remoteData
     * @param Ico $ico
     * @return Dates
     */
    public function normalize($remoteData, $ico): Dates
    {
        if (!$dates = $ico->getDates()) {
            $dates = new Dates();
        }
        if (!empty($remoteData)) {
            if ($remoteData['preIcoStart']) {
                $dates->setPresaleStart($this->getDateTimeFormat($remoteData['preIcoStart']));
            }
            if ($remoteData['preIcoEnd']) {
                $dates->setPresaleEnd($this->getDateTimeFormat($remoteData['preIcoEnd']));
            }
            if ($remoteData['icoStart']) {
                $dates->setIcoStart($this->getDateTimeFormat($remoteData['icoStart']));
            }
            if ($remoteData['icoEnd']) {
                $dates->setIcoEnd($this->getDateTimeFormat($remoteData['icoEnd']));
            }
            $dates->setIco($ico);
        }
        $this->em->persist($dates);
        return $dates;
    }

    /**
     * @param $value
     * @return \DateTime|null
     */
    private function getDateTimeFormat($value): ?\DateTime
    {
        $date = \DateTime::createFromFormat('Y-m-d G:i:s', $value);
        if($value === $date->format('Y-m-d G:i:s')) {
            return $date;
        }
        return null;
    }

}