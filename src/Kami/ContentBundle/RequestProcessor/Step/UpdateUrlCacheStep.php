<?php


namespace Kami\ContentBundle\RequestProcessor\Step;


use Kami\Component\RequestProcessor\Artifact;
use Kami\Component\RequestProcessor\ArtifactCollection;
use Kami\Component\RequestProcessor\Step\AbstractStep;
use Kami\ContentBundle\Entity\Post;
use Predis\Client;
use Symfony\Component\HttpFoundation\Request;

class UpdateUrlCacheStep extends AbstractStep
{
    /**
     * @var Client
     */
    private $urlCache;

    /**
     * UpdateUrlCacheStep constructor.
     * @param Client $urlCache
     */
    public function __construct(Client $urlCache)
    {
        $this->urlCache = $urlCache;
    }

    public function execute(Request $request): ArtifactCollection
    {
        /** @var Post $post */
        $post = $this->getArtifact('entity');
        $this->urlCache->set($post->getUrl(), $post->getValidatedBy()->count());
        return new ArtifactCollection([
            new Artifact('cached', true)
        ]);
    }

    public function getRequiredArtifacts(): array
    {
        return ['entity'];
    }

}