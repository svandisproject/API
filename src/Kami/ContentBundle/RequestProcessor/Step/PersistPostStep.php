<?php


namespace Kami\ContentBundle\RequestProcessor\Step;


use Doctrine\Bundle\DoctrineBundle\Registry;
use Kami\Component\RequestProcessor\Artifact;
use Kami\Component\RequestProcessor\ArtifactCollection;
use Kami\Component\RequestProcessor\Step\AbstractStep;
use Kami\WorkerBundle\Entity\Worker;
use Psr\Log\LoggerInterface;
use Pusher\Pusher;
use Pusher\PusherException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class PersistPostStep extends AbstractStep
{
    /**
     * @var Registry
     */
    private $doctrine;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var Pusher
     */
    private $pusher;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(Registry $doctrine, TokenStorageInterface $tokenStorage, Pusher $pusher, LoggerInterface $logger)
    {
        $this->doctrine = $doctrine;
        $this->tokenStorage = $tokenStorage;
        $this->pusher = $pusher;
        $this->logger = $logger;
    }

    public function execute(Request $request) : ArtifactCollection
    {
        $entity = $this->getArtifact('entity');

        if(true !== $this->getArtifact('validation')) {
            return new ArtifactCollection();
        }

        try {
            if (null === $entity->getId() && $this->tokenStorage->getToken()->getUser() instanceof Worker) {
               $entity->setCreatedBy($this->tokenStorage->getToken()->getUser());
            }
            $this->doctrine->getManager()->persist($entity);
            $this->doctrine->getManager()->flush();
        } catch (\Exception $exception) {
            throw new BadRequestHttpException('Your request can not be stored', $exception);
        }
        try {
            $this->pusher->trigger('news-feed', 'new-post', [
                'message' => [
                    'title' => $entity->getTitle(),
                    'content' => $entity->getContent(),
                    'source' => $entity->getSource(),
                    'published_at' => $entity->getPublishedAt()->getTimestamp(),
                    'tags' => $entity->getTags()->toArray()
                ]
            ]);
        } catch (PusherException $exception) {
            $this->logger->error('Failed to send a pusher message');
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