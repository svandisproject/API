<?php

namespace Tests\KamiWorkerBundle\Model;

use Kami\WorkerBundle\Entity\FacebookFeed;
use Kami\WorkerBundle\Entity\RedditFeed;
use Kami\WorkerBundle\Entity\TwitterFeed;
use Kami\WorkerBundle\Entity\WebFeed;
use Kami\WorkerBundle\Model\Task;

class TaskTest extends \PHPUnit_Framework_TestCase
{

    public function testFromFacebookFeed()
    {
        $facebookFeed = new FacebookFeed();
        $facebookFeed
            ->setEmail('test@test.com')
            ->setPassword('test')
            ->setTimeInterval(1000)
        ;

        $task = new Task();
        $task->setType('facebook')
            ->setConfig([
                'email' => 'test@test.com',
                'password' => 'test'
            ])
            ->setTimeInterval(1000)
        ;

        $this->assertEquals($task, Task::fromFacebookFeed($facebookFeed));
    }

    public function testFromTwitterFeed()
    {
        $twitterFeed = new TwitterFeed();
        $twitterFeed
            ->setMode('test')
            ->setAccessTokenKey('test')
            ->setAccessTokenSecret('test')
            ->setConsumerKey('test')
            ->setConsumerSecret('test')
            ->setTimeInterval(1000)
        ;
        $task = new Task();
        $task->setType('twitter')
            ->setConfig([
                'mode' => 'test',
                'consumerKey' => 'test',
                'consumerSecret' => 'test',
                'accessTokenKey' => 'test',
                'accessTokenSecret' => 'test',
            ])
            ->setTimeInterval(1000);

        $this->assertEquals($task, Task::fromTwitterFeed($twitterFeed));    }

    public function testFromWebFeed()
    {
        $webFeed = new WebFeed();
        $webFeed
            ->setContentSelector('test')
            ->setTitleSelector('test')
            ->setPublishedAtSelector('test')
            ->setDateFormat('test')
            ->setTimeInterval(1000);

        $task = new Task();
        $task
            ->setType('web')
            ->setConfig([
                'titleSelector' => 'test',
                'contentSelector' => 'test',
                'publishedAtSelector' => 'test',
                'dateFormat' => 'test',
            ])
            ->setTimeInterval(1000);

        $this->assertEquals($task, Task::fromWebFeed($webFeed));
    }

    public function testFromRedditFeed()
    {
        $redditFeed = new RedditFeed();
        $redditFeed
            ->setClientId('test')
            ->setClientSecret('test')
            ->setUsername('test')
            ->setPassword('test')
            ->setTimeInterval(1000);

        $task = new Task();
        $task
            ->setType('reddit')
            ->setConfig([
                'clientId' => 'test',
                'clientSecret' => 'test',
                'username' => 'test',
                'password' => 'test'
            ])
            ->setTimeInterval(1000);

        $this->assertEquals($task, Task::fromRedditFeed($redditFeed));
    }


}
