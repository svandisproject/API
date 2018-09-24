<?php

namespace Kami\IcoBundle\RequestProcessor;


use Doctrine\ORM\QueryBuilder;
use Kami\ApiCoreBundle\Security\AccessManager;
use Kami\AssetBundle\Entity\Asset;
use Kami\Component\RequestProcessor\Artifact;
use Kami\Component\RequestProcessor\ArtifactCollection;
use Kami\Component\RequestProcessor\Step\AbstractStep;
use Kami\IcoBundle\Entity\Finance;
use Kami\IcoBundle\Entity\Ico;
use Kami\IcoBundle\Entity\Industry;
use Kami\IcoBundle\Entity\Person;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class IcoSortStep extends AbstractStep
{
    protected $accessManager;

    public function __construct(AccessManager $accessManager)
    {
        $this->accessManager = $accessManager;
    }

    public function execute(Request $request) : ArtifactCollection
    {
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = $this->getArtifact('query_builder');
        /** @var \ReflectionClass $reflection */
        $reflection = $this->getArtifact('reflection');
        $query = 'e.%s';
        $sort = $request->get('sort', $request->attributes->get('_sort'));
        switch ($sort){
            case 'competitors':
                $reflection = new \ReflectionClass(Ico::class);
                $query = 'competitors.%s';
                $sort = 'title';
                break;
            case 'partners':
                $reflection = new \ReflectionClass(Ico::class);
                $query = 'partners.%s';
                $sort = 'title';
                break;
            case 'team':
                $reflection = new \ReflectionClass(Person::class);
                $query = 'team.%s';
                $sort = 'name';
                break;
            case 'industries':
                $reflection = new \ReflectionClass(Industry::class);
                $query = 'industries.%s';
                $sort = 'title';
                break;
            case 'asset.price':
                $reflection = new \ReflectionClass(Asset::class);
                $query = 'asset.%s';
                $sort = 'price';
                break;
            case 'finance.token_price_eth':
                $reflection = new \ReflectionClass(Finance::class);
                $query = 'finance.%s';
                $sort = 'tokenPriceEth';
                break;
        }
        $direction = $request->get('direction', $request->attributes->get('_sort_direction'));
        if (!in_array($direction, ['asc', 'desc'])) {
            throw new BadRequestHttpException();
        }
        $property = $reflection->getProperty($sort);
        if ($sort !== $request->attributes->get('_sort')
            && !$this->accessManager->canAccessProperty($property)) {
            throw new AccessDeniedHttpException();
        }
        $queryBuilder->orderBy(sprintf($query, $sort), $direction);
        return new ArtifactCollection([
            new Artifact('sort_applied', true)
        ]);
    }



    public function getRequiredArtifacts() : array
    {
        return ['query_builder', 'reflection', 'select_query_built', 'access_granted'];
    }
}