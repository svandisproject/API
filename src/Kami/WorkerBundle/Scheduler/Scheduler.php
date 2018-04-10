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
     * ApiManager constructor.
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
    public function getScheduleIndex()
    {
        $data = [
            'web' => $this->doctrine->getRepository(WebFeed::class)->findAll(),
            'facebook' => $this->doctrine->getRepository(FacebookFeed::class)->findAll(),
            'twitter' => $this->doctrine->getRepository(TwitterFeed::class)->findAll(),
        ];

        $tasks = [];
        foreach ($data as $task => $service) {
            foreach ($service as $item) {
                $method = 'get'.ucfirst($task);
                array_push($tasks, $this->$method($item));
            }
        }

        return $tasks;
    }

    private function getWeb($item)
    {
        $arr = [];
        $arr['name'] = 'web';
        $arr['config'] = [];
        $arr['config'] = [
            'titleSelector' => $item->getTitleSelector(),
            'contentSelector' => $item->getContentSelector(),
            'publishedAtSelector' => $item->getPublishedAtSelector(),
            'dateFormat' => $item->getDateFormat(),
            'timeInterval' => $item->getTimeInterval(),
        ];
        return $arr;
    }

    private function getFacebook($item)
    {
        $arr = [];
        $arr['name'] = 'facebook';
        $arr['config'] = [];
        $arr['config'] = [
            'email' => $item->getEmail(),
            'password' => $item->getPassword(),
            'timeInterval' => $item->getTimeInterval(),
        ];
        return $arr;
    }

    private function getTwitter($item)
    {
        $arr = [];
        $arr['name'] = 'twitter';
        $arr['config'] = [];
        $arr['config'] = [
            'mode' => $item->getMode(),
            'consumerKey' => $item->getConsumerKey(),
            'consumerSecret' => $item->getConsumerSecret(),
            'accessTokenKey' => $item->getAccessTokenKey(),
            'accessTokenSecret' => $item->getAccessTokenSecret(),
            'timeInterval' => $item->getTimeInterval(),
        ];
        return $arr;
    }
}
