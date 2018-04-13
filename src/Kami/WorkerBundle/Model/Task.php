<?php

namespace Kami\WorkerBundle\Model;


use Kami\WorkerBundle\Entity\FacebookFeed;
use Kami\WorkerBundle\Entity\RedditFeed;
use Kami\WorkerBundle\Entity\TwitterFeed;
use Kami\WorkerBundle\Entity\WebFeed;
use JMS\Serializer\Annotation as JMS;

/**
 * Class Task
 * @package Kami\WorkerBundle\Model
 *
 * @JMS\ExclusionPolicy("all")
 */
class Task
{
    /**
     * @var string
     * @JMS\Expose
     */
    private $type;

    /**
     * @var array
     * @JMS\Expose
     */
    private $config = [];

    /**
     * @var int
     * @JMS\Expose
     */
    private $timeInterval = 60000;

    public static function fromWebFeed(WebFeed $webFeed)
    {
        $task = new self;
        $task->type = 'web';
        $task->config = [
            'titleSelector' => $webFeed->getTitleSelector(),
            'contentSelector' => $webFeed->getContentSelector(),
            'publishedAtSelector' => $webFeed->getPublishedAtSelector(),
            'dateFormat' => $webFeed->getDateFormat(),
        ];
        $task->timeInterval = $webFeed->getTimeInterval();

        return $task;
    }

    public static function fromFacebookFeed(FacebookFeed $facebookFeed)
    {
        $task = new self;
        $task->type = 'facebook';
        $task->config = [
            'email' => $facebookFeed->getEmail(),
            'password' => $facebookFeed->getPassword(),
        ];
        $task->timeInterval = $facebookFeed->getTimeInterval();

        return $task;
    }

    public static function fromTwitterFeed(TwitterFeed $twitterFeed)
    {
        $task = new self;
        $task->type = 'twitter';
        $task->config = [
            'mode' => $twitterFeed->getMode(),
            'consumerKey' => $twitterFeed->getConsumerKey(),
            'consumerSecret' => $twitterFeed->getConsumerSecret(),
            'accessTokenKey' => $twitterFeed->getAccessTokenKey(),
            'accessTokenSecret' => $twitterFeed->getAccessTokenSecret(),
        ];
        $task->timeInterval = $twitterFeed->getTimeInterval();

        return $task;
    }

    public static function fromRedditFeed(RedditFeed $redditFeed)
    {
        $task = new self;
        $task->type = 'reddit';
        $task->config = [
            'clientId' => $redditFeed->getClientId(),
            'clientSecret' => $redditFeed->getClientSecret(),
            'username' => $redditFeed->getUsername(),
            'password' => $redditFeed->getPassword()
        ];
        $task->setTimeInterval($redditFeed->getTimeInterval());

        return $task;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Task
     */
    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @param array $config
     * @return Task
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @return int
     */
    public function getTimeInterval()
    {
        return $this->timeInterval;
    }

    /**
     * @param int $timeInterval
     * @return Task
     */
    public function setTimeInterval(int $timeInterval)
    {
        $this->timeInterval = $timeInterval;
        return $this;
    }
}