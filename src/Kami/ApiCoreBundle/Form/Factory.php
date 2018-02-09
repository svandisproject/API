<?php

namespace Kami\ApiCoreBundle\Form;

use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Util\Inflector;
use Kami\ApiCoreBundle\Annotation\CanBeCreatedBy;
use Kami\ApiCoreBundle\Annotation\CanBeEditedBy;
use Kami\ApiCoreBundle\Annotation\Form;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

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
     * @var TokenStorage
     */
    private $tokenStorage;

    /**
     * Factory constructor.
     * @param FormFactory $formFactory
     * @param CachedReader $annotationReader
     * @param TokenStorage $tokenStorage
     */
    public function __construct(FormFactory $formFactory, CachedReader $annotationReader, TokenStorage $tokenStorage)
    {
        $this->formFactory = $formFactory;
        $this->annotationReader = $annotationReader;
        $this->tokenStorage = $tokenStorage;
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
            ['csrf_protection' => false]
        );
        foreach ($reflection->getProperties() as $property) {
            if($property->getName() !== 'id') {
                $propertyAnnotations = $this->annotationReader->getPropertyAnnotations($property);
                $canBeCreated = false;
                $form = null;
                foreach ($propertyAnnotations as $annotation) {
                    if ($annotation instanceof CanBeCreatedBy) {
                        $canBeCreated = true;
                    }
                    if ($annotation instanceof Form) {
                        $form = $annotation;
                    }
                }
                if ($canBeCreated && !isset($form)) {
                    $builder->add($property->getName());
                }
                if ($canBeCreated && $form instanceof Form) {
                    $builder->add($form->type, $form->options);
                }
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
            ['csrf_protection' => false]
        );
        $builder->setMethod('PUT');
        foreach ($reflection->getProperties() as $property) {
            if($property->getName() !== 'id') {
                $propertyAnnotations = $this->annotationReader->getPropertyAnnotations($property);
                $canBeEdited = false;
                $form = null;
                foreach ($propertyAnnotations as $annotation) {
                    if ($annotation instanceof CanBeEditedBy) {
                        $canBeEdited = true;
                    }
                    if ($annotation instanceof Form) {
                        $form = $annotation;
                    }
                }
                if ($canBeEdited && !isset($form)) {
                    $builder->add($property->getName());
                }
                if ($canBeEdited && $form instanceof Form) {
                    $builder->add($form->type, $form->options);
                }
            }
        }

        return $builder->getForm();
    }
}