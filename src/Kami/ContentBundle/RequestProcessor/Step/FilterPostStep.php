<?php

namespace Kami\ContentBundle\RequestProcessor\Step;

use Doctrine\Common\Inflector\Inflector;
use Doctrine\ORM\Mapping\Annotation;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\QueryBuilder;
use Kami\ApiCoreBundle\RequestProcessor\Step\Filter\FilterStep;
use Kami\ApiCoreBundle\Security\AccessManager;
use Kami\Component\RequestProcessor\ArtifactCollection;
use Kami\Component\RequestProcessor\ProcessingException;
use Kami\Component\RequestProcessor\Step\AbstractStep;
use ReflectionException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Doctrine\Common\Annotations\Reader;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class FilterPostStep extends FilterStep
{
    public function applyNeFilter($filter, QueryBuilder $queryBuilder, $shortcut, $index)
    {
        $subQueryBuilder = clone $queryBuilder;
        $subQuery = $subQueryBuilder
            ->where(sprintf($shortcut.'.%s = :%s_value', $filter['property'], $filter['property'].$index))
            ->setParameter(sprintf('%s_value', $filter['property'].$index), $filter['value'])
            ->getQuery()
            ->getArrayResult()
        ;
        $arr = [];
        foreach ($subQuery as $id) {
            array_push($arr, $id['id']);
        }

        $queryBuilder
            ->andWhere($queryBuilder->expr()->notIn('e.id', $arr))
            ->orWhere($shortcut.' is NULL');
    }
}