<?php


namespace Kami\ContentBundle\RequestProcessor\Step;


use Cassandra\Uuid;
use Kami\Component\RequestProcessor\Artifact;
use Kami\Component\RequestProcessor\ArtifactCollection;
use Kami\Component\RequestProcessor\Step\AbstractStep;
use Kami\ContentBundle\Entity\Post;
use M6Web\Bundle\CassandraBundle\Cassandra\Client
    ;use Symfony\Component\HttpFoundation\Request;

class UpdateUrlCacheStep extends AbstractStep
{
    /**
     * @var Client
     */
    private $cassandra;

    /**
     * UpdateUrlCacheStep constructor.
     * @param Client $cassandra
     */
    public function __construct(Client $cassandra)
    {
        $this->cassandra = $cassandra;
    }

    public function execute(Request $request): ArtifactCollection
    {
        /** @var Post $post */
        $post = $this->getArtifact('entity');
        $statement = $this->cassandra->prepare(
            'INSERT INTO svandis_url_cache.crawled_urls (hash, url, confirmations) VALUES (?, ?, ?)'
        );
        $this->cassandra->execute(
            $statement,
            ['arguments' => [md5($post->getUrl()), $post->getUrl(), $post->getValidatedBy()->count()]]
        );

        return new ArtifactCollection([
            new Artifact('cached', true)
        ]);
    }

    public function getRequiredArtifacts(): array
    {
        return ['entity'];
    }

}