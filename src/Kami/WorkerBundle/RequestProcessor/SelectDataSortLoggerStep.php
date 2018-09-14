<?php


namespace Kami\WorkerBundle\RequestProcessor;

use Cassandra\SimpleStatement;
use Kami\Component\RequestProcessor\Artifact;
use Kami\Component\RequestProcessor\ArtifactCollection;
use Kami\Component\RequestProcessor\Step\AbstractStep;
use Symfony\Component\HttpFoundation\Request;
use M6Web\Bundle\CassandraBundle\Cassandra\Client as CassandraClient;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SelectDataSortLoggerStep extends AbstractStep
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
     */
    public function execute(Request $request) : ArtifactCollection
    {
        $perPage = $request->query->getInt('per_page', 10);
        $currentPage = $request->query->getInt('page', 1);

        $data = [];
        $pageData = [];
        $statement = new SimpleStatement('SELECT * FROM svandis_url_cache.logs ALLOW FILTERING;');
        $result = $this->cassandra->execute($statement);

        foreach ($result as $row) {
            $log = [
                'user_id' => $row['user_id'],
                'log' => $row['log'],
                'task_type' => $row['task_type'],
                'time' => (new \DateTime())->setTimestamp(time($row['time'])),
            ];
            array_push($data, $log);
        }

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
        return [];
    }


}