<?php


namespace Kami\IcoBundle\Normalizer;


use Doctrine\ORM\EntityManager;

abstract class AbstractPropertyNormalizer implements PropertyNormalizerInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * AbstractPropertyNormalizer constructor.
     * @param EntityManager $manager
     */
    public function __construct(EntityManager $manager)
    {
        $this->entityManager = $manager;
    }
}