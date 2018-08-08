<?php


namespace Kami\AssetBundle\RequestProcessor\Step;


use Doctrine\ORM\QueryBuilder;
use Kami\ApiCoreBundle\Security\AccessManager;
use Kami\Component\RequestProcessor\Artifact;
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
        $sort = $request->get('sort', $request->attributes->get('_sort'));

        switch ($sort){
            case 'weekly_change':
                $sort = 'weeklyChange';
                break;
            case 'year_to_day_change':
                $sort = 'yearToDayChange';
                break;
        }

        $direction = $request->get('direction', $request->attributes->get('_sort_direction'));
        if (!in_array($direction, ['asc', 'desc'])) {
            throw new BadRequestHttpException();
        }
        /** @var \ReflectionClass $reflection */
        $reflection = $this->getArtifact('reflection');
        $property = $reflection->getProperty($sort);

        if ($sort !== $request->attributes->get('_sort')
            && !$this->accessManager->canAccessProperty($property)) {
            throw new AccessDeniedHttpException();
        }

        $queryBuilder->orderBy(sprintf('e.%s', $sort), $direction);
        return new ArtifactCollection([
            new Artifact('sort_applied', true)
        ]);
    }

    public function getRequiredArtifacts() : array
    {
        return ['query_builder', 'reflection', 'select_query_built', 'access_granted'];
    }

}