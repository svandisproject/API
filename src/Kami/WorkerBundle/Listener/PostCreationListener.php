<?php


namespace Kami\WorkerBundle\Listener;


use Doctrine\Bundle\DoctrineBundle\Registry;
use Kami\ApiCoreBundle\Event\CrudEvent;
use Kami\ContentBundle\Entity\Post;
use Kami\WorkerBundle\Entity\Worker;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class PostCreationListener
{
    private $doctrine;

    private $worker;

    public function __construct(Registry $doctrine, TokenStorage $tokenStorage)
    {
        $this->doctrine = $doctrine;
        if ($tokenStorage->getToken()->getUser() instanceof Worker) {
            $this->worker = $tokenStorage->getToken()->getUser();
        }
    }

    public function onKamiApiCoreResourceCreate(CrudEvent $event)
    {
        if (Post::class === $event->getReflection()->getName()) {
            $submittedPost = $event->getRequest()->get('post');
            $existingPost = $this->doctrine->getRepository(Post::class)->findOneBy([
                'url' => $submittedPost['url']
            ]);

            if ($existingPost) {
                if ($existingPost->getTitle() == $submittedPost['title']
                    && $existingPost->getContent() == $submittedPost['content']) {
                    if ($this->worker) {
                       $existingPost->addValidatedBy($this->worker);
                       $this->doctrine->getManager()->persist($existingPost);
                       $this->doctrine->getManager()->flush();
                    }
                }
            }
        }
    }
}