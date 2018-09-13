<?php

namespace Kami\WorkerBundle\Logger;

use Kami\ApiCoreBundle\Annotation as Api;

/**
 * Class Log
 * @package Kami\WorkerBundle\Log
 * @Api\AnonymousAccess()
 * @Api\AnonymousCreate()
 */
class Log
{
    /**
     * @var string | null
     *
     * @Api\AnonymousAccess()
     * @Api\AnonymousCreate()
     */
    private $taskType;

    /**
     * @var int | null
     *
     * @Api\AnonymousAccess()
     * @Api\AnonymousCreate()
     */
    private $userId;

    /**
     * @var string | null
     *
     * @Api\AnonymousAccess()
     * @Api\AnonymousCreate()
     */
    private $log;

    /**
     * @var \DateTime | null
     *
     * @Api\AnonymousAccess()
     * @Api\AnonymousCreate()
     */
    private $time;

    /**
     * @return string
     */
    public function getLog(): ?string
    {
        return $this->log;
    }

    /**
     * @param string $log
     */
    public function setLog(string $log): void
    {
        $this->log = $log;
    }

    /**
     * @return string
     */
    public function getTaskType(): ?string
    {
        return $this->taskType;
    }

    /**
     * @param string $taskType
     */
    public function setTaskType(string $taskType): void
    {
        $this->taskType = $taskType;
    }

    /**
     * @return \DateTime
     */
    public function getTime(): ?\DateTime
    {
        return $this->time;
    }

    /**
     * @param \DateTime $time
     */
    public function setTime(\DateTime $time): void
    {
        $this->time = $time;
    }

    /**
     * @return int
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

}