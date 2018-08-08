<?php

namespace Kami\AssetBundle\RequestProcessor\Step;


use Doctrine\ORM\QueryBuilder;
use Kami\ApiCoreBundle\Security\AccessManager;
use Kami\AssetBundle\Entity\CoinMarketCap;
use Kami\Component\RequestProcessor\ArtifactCollection;
use Kami\Component\RequestProcessor\Step\AbstractStep;
use Kami\IcoBundle\Entity\Industry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class FilterTradebleTokenStep extends AbstractStep
{
    protected $accessManager;

    public function __construct(AccessManager $accessManager)
    {
        $this->accessManager = $accessManager;
    }

    public function execute(Request $request) : ArtifactCollection
    {
        /** @var array $filters */
        $filters = $this->getArtifact('filters');

        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = $this->getArtifact('query_builder');
        /** @var \ReflectionClass $reflection */
        $reflection = $this->getArtifact('reflection');

        foreach ($filters as $index => $filter) {
            $queryModel = 'e';
            switch ($filter['property']){
                case 'industry':
                    $queryBuilder->leftJoin(sprintf('ico.%s', 'industries'), 'industry');
                    $industryReflection = new \ReflectionClass(Industry::class);
                    $property = $industryReflection->getProperty('title');
                    $filter['property'] = 'title';
                    $queryModel = 'industry';
                    break;
                case 'volume':
                    $marketCapReflection = new \ReflectionClass(CoinMarketCap::class);
                    $property = $marketCapReflection->getProperty('volume24');
                    $filter['property'] = 'volume24';
                    $queryModel = 'market_cap';
                    break;
                case 'weekly_change':
                    $property = $reflection->getProperty('weeklyChange');
                    $filter['property'] = 'weeklyChange';
                    break;
                case 'year_to_day_change':
                    $property = $reflection->getProperty('yearToDayChange');
                    $filter['property'] = 'yearToDayChange';
                    break;
                default:
                    $property = $reflection->getProperty($filter['property']);
            }

            if (!$this->accessManager->canAccessProperty($property)) {
                throw new AccessDeniedHttpException();
            }
            call_user_func([$this, sprintf('apply%sFilter', $filter['type'])], $filter, $queryBuilder, $queryModel);
        }

        return new ArtifactCollection();
    }

    public function applyEqFilter($filter, QueryBuilder $queryBuilder, $queryModel)
    {
        $queryBuilder
            ->andWhere(sprintf($queryModel.'.%s = :%s_value', $filter['property'], $filter['property']))
            ->setParameter(sprintf('%s_value', $filter['property']), $filter['value']);
    }

    public function applyGtFilter($filter, QueryBuilder $queryBuilder, $queryModel)
    {
        $queryBuilder
            ->andWhere(sprintf($queryModel.'.%s > :%s_value', $filter['property'], $filter['property']))
            ->setParameter(sprintf('%s_value', $filter['property']), $filter['value']);
    }

    public function applyLtFilter($filter, QueryBuilder $queryBuilder, $queryModel)
    {
        $queryBuilder
            ->andWhere(sprintf($queryModel.'.%s < :%s_value', $filter['property'], $filter['property']))
            ->setParameter(sprintf('%s_value', $filter['property']), $filter['value']);
    }

    public function applyInFilter($filter, QueryBuilder $queryBuilder, $queryModel)
    {
        $queryBuilder
            ->andWhere(sprintf($queryModel.'.%s IN (:%s_value)', $filter['property'], $filter['property']))
            ->setParameter(sprintf('%s_value', $filter['property']), $filter['value']);
    }

    public function applyBwFilter($filter, QueryBuilder $queryBuilder, $queryModel)
    {
        $queryBuilder
            ->andWhere(
                sprintf(
                    $queryModel.'.%s BETWEEN :%s_min_value AND :%s_max_value',
                    $filter['property'],
                    $filter['property'],
                    $filter['property']
                )
            )
            ->setParameter(sprintf('%s_min_value', $filter['property']), $filter['min'])
            ->setParameter(sprintf('%s_max_value', $filter['property']), $filter['max']);
        ;
    }

    public function applyLkFilter($filter, QueryBuilder $queryBuilder, $queryModel)
    {
        $queryBuilder
            ->andWhere(sprintf($queryModel.'.%s LIKE :%s_value', $filter['property'], $filter['property']))
            ->setParameter(sprintf('%s_value', $filter['property']), '%'.$filter['value'].'%');
    }

    public function getRequiredArtifacts() : array
    {
        return ['filters', 'query_builder', 'access_granted', 'reflection', 'select_query_built'];
    }
}