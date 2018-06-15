<?php


namespace Kami\WorkerBundle\Listener;


use Doctrine\ORM\Event\LifecycleEventArgs;
use Kami\ContentBundle\Entity\Post;
use Psr\Log\LoggerInterface;
use Pusher\Pusher;
use Pusher\PusherException;

class PostCreationListener
{
    /**
     * @var Pusher
     */
    private $pusher;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * PostCreationListener constructor.
     * @param Pusher $pusher
     * @param LoggerInterface $logger
     */
    public function __construct(Pusher $pusher, LoggerInterface $logger)
    {
        $this->pusher = $pusher;
        $this->logger = $logger;
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Post) {
           return;
        }

        try {
            $result =$this->pusher->trigger('news-feed', 'new-post', [
                'message' => [
                    'title' => $entity->getTitle(),
                    'content' => $entity->getContent(),
                    'source' => $entity->getSource(),
                    'publishedAt' => $entity->getPublishedAt()->getTimestamp(),
                    'tags' => $entity->getTags()
                ]
            ]);
            var_dump($result);
        } catch (PusherException $exception) {
            $this->logger->error(
                sprintf('Failed to send pusher notifications with exception: "%s"', $exception->getMessage())
            );
        }
    }
}