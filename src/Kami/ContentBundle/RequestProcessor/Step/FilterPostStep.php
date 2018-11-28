<?php

namespace Kami\ContentBundle\RequestProcessor\Step;

use Doctrine\ORM\QueryBuilder;
use Kami\ApiCoreBundle\RequestProcessor\Step\Filter\FilterStep;

class FilterPostStep extends FilterStep
{
    public function applyNeFilter($filter, QueryBuilder $queryBuilder, $shortcut, $index)
    {
        $subQueryBuilder = clone $queryBuilder;
        $subQueryBuilder->resetDQLParts(['where']);
        $subQueryBuilder->setParameters([]);
        $subQuery = $subQueryBuilder
            ->where(sprintf($shortcut.'.%s = :%s_value', $filter['property'], $filter['property'].$index))
            ->setParameter(sprintf('%s_value', $filter['property'].$index), $filter['value'])
            ->orWhere($shortcut.' is NULL')
            ->getQuery()
            ->getArrayResult()
        ;
        $arr = [0];
        foreach ($subQuery as $id) {
            array_push($arr, $id['id']);
        }

        $queryBuilder->andWhere($queryBuilder->expr()->notIn('e.id', $arr));
    }
}