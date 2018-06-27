<?php


namespace Kami\IcoBundle\Normalizer;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Kami\IcoBundle\Entity\Ico;
use Kami\IcoBundle\Normalizer\IcoBench\Property\ScalarNormalizer;
use function ucfirst;

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
         foreach ($this->getNormalizingMap() as $property => $config) {
             $normalizer = $this->getNormalizer($config['normalizer']);
             $method = 'set'.ucfirst($property);
             $ico->$method($normalizer->normalize($this->getValueByPath($remoteData, $config['property'])));
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
      * @return mixed
      */
     protected function getNormalizer($name)
     {
         $normalizer = $this->normalizers->get($name);
         if(!$normalizer) {
             throw new \RuntimeException(sprintf('Normalizer "%s" does not exist', $name));
         }

         return $normalizer;
     }
 }