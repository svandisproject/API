<?php


namespace Kami\WorkerBundle\RequestProcessor;

use Cassandra\BatchStatement;
use Cassandra\SimpleStatement;
use Kami\Component\RequestProcessor\Artifact;
use Kami\Component\RequestProcessor\ArtifactCollection;
use Kami\Component\RequestProcessor\Step\AbstractStep;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use M6Web\Bundle\CassandraBundle\Cassandra\Client as CassandraClient;

class FilterSortPaginateLoggerStep extends AbstractStep
{
    /**
     * @var CassandraClient
     */
    protected $cassandra;

    public function __construct(CassandraClient $cassandra)
    {
        $this->cassandra = $cassandra;
    }

    public function execute(Request $request) : ArtifactCollection
    {
//        /** @var \ReflectionClass $reflection */
//        $reflection = $this->getArtifact('reflection');

        $sort = $request->get('sort', 'time');
        $direction = $request->get('direction', 'time');
        if (!in_array($direction, ['asc', 'desc'])) {
            throw new BadRequestHttpException();
        }

//        dump($sort);die;
        $query = "select * from logs ORDER BY $sort $direction ALLOW FILTERING ;";
        $statement = new SimpleStatement('SELECT * FROM svandis_url_cache.logs');

    }

    public function getRequiredArtifacts() : array
    {
        return [];
    }


}