<?php

namespace Kami\ApiCoreBundle\Form;

use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Util\Inflector;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormFactory;

class Factory
{
    /**
     * @var FormFactory
     */
    private $formFactory;

    /**
     * @var CachedReader
     */
    private $annotationReader;

    /**
     * Factory constructor.
     * @param FormFactory $formFactory
     * @param CachedReader $annotationReader
     */
    public function __construct(FormFactory $formFactory, CachedReader $annotationReader)
    {
        $this->formFactory = $formFactory;
        $this->annotationReader = $annotationReader;
    }

    /**
     * @param $entity
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getCreateForm($entity)
    {
        $reflection = new \ReflectionClass($entity);
        $builder = $this->formFactory->createNamedBuilder(
            Inflector::tableize($reflection->getShortName()),
            FormType::class,
            $entity,
            ['csrf_protection'=>false]
        );
        foreach ($reflection->getProperties() as $property) {
            if($property->getName() !== 'id') {
                $builder->add($property->getName());
            }
        }

        return $builder->getForm();
    }

    /**
     * @param $entity
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getEditForm($entity)
    {
        $reflection = new \ReflectionClass($entity);
        $builder = $this->formFactory->createNamedBuilder(
            Inflector::tableize($reflection->getShortName()),
            FormType::class,
            $entity,
            ['csrf_protection'=>false]
        );
        $builder->setMethod('PUT');
        foreach ($reflection->getProperties() as $property) {
            if($property->getName() !== 'id') {
                $builder->add($property->getName());
            }
        }

        return $builder->getForm();
    }
}