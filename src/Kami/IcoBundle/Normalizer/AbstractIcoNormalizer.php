<?php


namespace Kami\IcoBundle\Normalizer;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Kami\IcoBundle\Entity\Ico;

 //todo: This should be refactored to use PropertyNormalizers
abstract class AbstractIcoNormalizer implements IcoNormalizerInterface
{
     /**
      * @var EntityManager
      */
    protected $entityManager;

     /**
      * @var ArrayCollection
      */
    protected $normalizers;

    public function __construct(EntityManager $manager)
    {
        $this->entityManager = $manager;
    }

     public function normalize(Ico $ico, $remoteData) : Ico
     {
         foreach ($this->getPropertyMap() as $property => $path) {

             if (is_array($path)) {
                 $normalizer = $this->getNormalizer($path['normalizer']);
                 $normalizer->fromRemote($ico, $this->getValueByPath($remoteData, $path['property']));
             } else {
                 $value = $this->getValueByPath($remoteData, $path);
                 $method = 'set'.ucfirst($property);
                 $ico->$method($value);
             }
         }
        return $ico;
     }

     private function getValueByPath(array $remoteData, string $path)
     {
         $data = $remoteData;
         $keys = explode('.', $path);

         foreach ($keys as $key) {
             $data = $data[$key];
         }

         return $data;
     }

     /**
      * @param $name
      * @return AbstractIcoNormalizer
      */
     protected function getNormalizer($name) : AbstractIcoNormalizer
     {
         $normalizer = $this->normalizers->get($name);
         if(!$normalizer) {
             throw new \RuntimeException(sprintf('Normalizer "%s" does not exist', $name));
         }

         return $normalizer;
     }
 }