<?php


namespace Kami\WorkerBundle\RequestProcessor;

use Cassandra\BatchStatement;
use Kami\Component\RequestProcessor\Artifact;
use Kami\Component\RequestProcessor\ArtifactCollection;
use Kami\Component\RequestProcessor\Step\AbstractStep;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use M6Web\Bundle\CassandraBundle\Cassandra\Client as CassandraClient;

class PersistLoggerStep extends AbstractStep
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
        $entity = $this->getArtifact('entity');

        if(true !== $this->getArtifact('validation')) {
            return new ArtifactCollection();
        }

        try {
            $prepared = $this->cassandra->prepare(
                'INSERT INTO svandis_url_cache.logs (task_type, user_id, time, log) 
                        VALUES (?, ?, toUnixTimestamp(now()), ?);'
            );
            $batch = new BatchStatement(\Cassandra::BATCH_LOGGED);

            $batch->add($prepared, [
                'task_type' => $entity->getTaskType(),
                'user_id' =>  intval($entity->getUserId()),
                'log' =>  $entity->getLog(),
            ]);

            $this->cassandra->execute($batch);
        } catch (\Cassandra\Exception $exception) {
            throw new BadRequestHttpException('Your request can not be stored', $exception);
        }

        return new ArtifactCollection([
            new Artifact('response_data', $entity),
            new Artifact('status', 200)
        ]);
    }

    public function getRequiredArtifacts() : array
    {
        return ['validation', 'entity', 'access_granted'];
    }


}