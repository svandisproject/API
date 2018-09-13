<?php


namespace Kami\AssetBundle\RequestProcessor\Step;


use Doctrine\ORM\QueryBuilder;
use Kami\ApiCoreBundle\Security\AccessManager;
use Kami\Component\RequestProcessor\Artifact;
use Kami\AssetBundle\Entity\MarketCap;
use Kami\Component\RequestProcessor\ArtifactCollection;
use Kami\Component\RequestProcessor\Step\AbstractStep;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class SortStep extends AbstractStep
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
            case 'weekly_change':
                $sort = 'weeklyChange';
                break;
            case 'year_to_day_change':
                $sort = 'yearToDayChange';
                break;
            case 'volume':
                $reflection = new \ReflectionClass(MarketCap::class);
                $query = 'market_cap.%s';
                $sort = 'volume24';
                break;
            case 'market_cap':
                $reflection = new \ReflectionClass(MarketCap::class);
                $query = 'market_cap.%s';
                $sort = 'marketCap';
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