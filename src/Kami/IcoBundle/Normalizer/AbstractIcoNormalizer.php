<?php


namespace Kami\IcoBundle\Normalizer;


 use Doctrine\ORM\EntityManager;
 use function explode;
 use function is_array;
 use Kami\IcoBundle\Entity\Ico;
 use function ucfirst;

 abstract class AbstractIcoNormalizer implements IcoNormalizerInterface
{
    private $entityManager;

    public function __construct(EntityManager $manager)
    {
        $this->entityManager = $manager;
    }

     public function fromRemote(Ico $ico, array $remoteData)
     {
         foreach ($this->getPropertyMap() as $property => $path) {

             if (is_array($path)) {

                 $apiProperty = $path['property'];

                 $normalizer = new $path['normalizer']($this->entityManager);
                 $normalizer->normalize($this->getByPath($remoteData, $apiProperty), $ico);
             } else {
                 $value = $this->getByPath($remoteData, $path);
                 $method = 'set'.ucfirst($property);
                 $ico->$method($value);
             }
         }
        return $ico;
     }

     private function getByPath(array $remoteData, string $path)
     {
         $data = $remoteData;
         $keys = explode('.', $path);

         foreach ($keys as $key) {
             $data = $data[$key];
         }

         return $data;
     }
 }