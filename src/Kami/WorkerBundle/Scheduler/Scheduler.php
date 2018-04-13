<?php

namespace Kami\WorkerBundle\Scheduler;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use JMS\Serializer\Serializer;
use Kami\ApiCoreBundle\ApiCoreEvents;
use Kami\ApiCoreBundle\Event\CrudEvent;
use Kami\ApiCoreBundle\Form\Factory;
use Kami\ApiCoreBundle\Security\AccessManager;
use Kami\WorkerBundle\Entity\FacebookFeed;
use Kami\WorkerBundle\Entity\TwitterFeed;
use Kami\WorkerBundle\Entity\WebFeed;
use Kami\WorkerBundle\Model\Task;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class Scheduler
 *
 * @package Kami\WorkerBundle\Scheduler
 */
class Scheduler
{
    /**
     * @var Registry
     */
    private $doctrine;

    /**
     * Scheduler constructor.
     *
     * @param Registry $doctrine
     */
    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @return array
     */
    public function getSchedule()
    {
        $feeds = array_merge(
            $this->doctrine->getRepository(WebFeed::class)->findAll(),
            $this->doctrine->getRepository(FacebookFeed::class)->findAll(),
            $this->doctrine->getRepository(TwitterFeed::class)->findAll()
        );
        $tasks = [];

        foreach ($feeds as $feed) {
            switch (get_class($feed)) {
                case WebFeed::class:
                    $tasks[] = Task::fromWebFeed($feed);
                    break;
                case FacebookFeed::class:
                    $tasks[] = Task::fromFacebookFeed($feed);
                    break;
                case TwitterFeed::class:
                    $tasks[] = Task::fromTwitterFeed($feed);
                    break;
                default:
                    break;
            }
        }

        return $tasks;
    }
}
