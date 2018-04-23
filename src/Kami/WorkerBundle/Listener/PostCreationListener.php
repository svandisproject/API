<?php


namespace Kami\WorkerBundle\Listener;


use Doctrine\Bundle\DoctrineBundle\Registry;
use Kami\ApiCoreBundle\Event\CrudEvent;
use Kami\ContentBundle\Entity\Post;
use Pusher\Pusher;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class PostCreationListener
{
    private $pusher;

    public function __construct(Pusher $pusher)
    {
        $this->pusher = $pusher;
    }

    public function onKamiApiCoreResourcecreated(CrudEvent $event)
    {
        if ($event->getData() instanceof Post) {
            $this->pusher->trigger('news-feed', 'new-post', [
                'message' => [
                    'title' => $event->getData()->getTitle(),
                    'content' => $event->getData()->getContent(),
                    'source' => $event->getData()->getSource(),
                    'publishedAt' => $event->getData()->getPublishedAt()->getTimestamp(),
                    'tags' => $event->getData()->getTags()
                ]
            ]);
        }
    }
}