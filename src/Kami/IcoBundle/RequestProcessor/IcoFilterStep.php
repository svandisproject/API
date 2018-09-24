<?php

namespace Kami\IcoBundle\RequestProcessor;

use Doctrine\ORM\QueryBuilder;
use Kami\ApiCoreBundle\Security\AccessManager;
use Kami\AssetBundle\Entity\Asset;
use Kami\Component\RequestProcessor\ArtifactCollection;
use Kami\Component\RequestProcessor\Step\AbstractStep;
use Kami\IcoBundle\Entity\Finance;
use Kami\IcoBundle\Entity\Ico;
use Kami\IcoBundle\Entity\Industry;
use Kami\IcoBundle\Entity\Person;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class IcoFilterStep extends AbstractStep
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
                case 'competitors':
                    $icoReflection = new \ReflectionClass(Ico::class);
                    $property = $icoReflection->getProperty('title');
                    $filter['property'] = 'title';
                    $queryModel = 'competitors';
                    break;
                case 'partners':
                    $icoReflection = new \ReflectionClass(Ico::class);
                    $property = $icoReflection->getProperty('title');
                    $filter['property'] = 'title';
                    $queryModel = 'partners';
                    break;
                case 'team':
                    $icoReflection = new \ReflectionClass(Person::class);
                    $property = $icoReflection->getProperty('name');
                    $filter['property'] = 'name';
                    $queryModel = 'team';
                    break;
                case 'industries':
                    $icoReflection = new \ReflectionClass(Industry::class);
                    $property = $icoReflection->getProperty('title');
                    $filter['property'] = 'title';
                    $queryModel = 'industries';
                    break;
                case 'asset.price':
                    $icoReflection = new \ReflectionClass(Asset::class);
                    $property = $icoReflection->getProperty('price');
                    $filter['property'] = 'price';
                    $queryModel = 'asset';
                    break;
                case 'finance.token_price_eth':
                    $icoReflection = new \ReflectionClass(Finance::class);
                    $property = $icoReflection->getProperty('tokenPriceEth');
                    $filter['property'] = 'token_price_eth';
                    $queryModel = 'finance';
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