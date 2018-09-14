<?php


namespace Kami\WorkerBundle\RequestProcessor;

use Cassandra\SimpleStatement;
use Kami\Component\RequestProcessor\Artifact;
use Kami\Component\RequestProcessor\ArtifactCollection;
use Kami\Component\RequestProcessor\Step\AbstractStep;
use Kami\WorkerBundle\Logger\Log;
use Symfony\Component\HttpFoundation\Request;
use M6Web\Bundle\CassandraBundle\Cassandra\Client as CassandraClient;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    /**
     * @param Request $request
     * @return ArtifactCollection
     * @throws \Cassandra\Exception
     * @throws \Kami\Component\RequestProcessor\ProcessingException
     */
    public function execute(Request $request) : ArtifactCollection
    {
        $filters = $this->getArtifact('filters');

        $query = 'SELECT * FROM svandis_url_cache.logs';
        foreach ($filters as $filter) {
            $condition1 = ' WHERE ';
            $condition2 = ($filter['property'] == 'user_id') ? "=" : "='";
            $condition3 = ($filter['property'] == 'user_id') ? "" : "'";
            if(strripos($query, $condition1)) $condition1 = ' AND ';

            $query .= $condition1 . $filter['property'] . $condition2 . $filter['value'] . $condition3;
        }
        $query .= ' ALLOW FILTERING;';

        $statement = new SimpleStatement($query);
        $result = $this->cassandra->execute($statement);

        $data = [];
        foreach ($result as $row) {
            $log = new Log();
            $log->setLog($row['log']);
            $log->setUserId($row['user_id']);
            $log->setTaskType($row['task_type']);
            $log->setTime((new \DateTime())->setTimestamp(time($row['time'])));

            array_push($data, $log);
        }

        $perPage = $request->query->getInt('per_page', 10);
        $currentPage = $request->query->getInt('page', 1);

        $pageData = [];
        $pagesCount = ceil(count($data)/$perPage);
        if ($currentPage < 1 || $currentPage > $pagesCount) {
            throw new NotFoundHttpException();
        }
        for($i = ($currentPage*$perPage) -1; $i >= ($currentPage*$perPage) - $perPage; $i--){
            if(isset($data[$i])) array_push($pageData, $data[$i]);
        }

        return new ArtifactCollection([
            new Artifact('response_data', array_reverse($pageData)),
            new Artifact('status', 200)
        ]);

    }

    public function getRequiredArtifacts() : array
    {
        return ['filters'];
    }


}