<?php

namespace Kami\WorkerBundle\Composer;

use Sensio\Bundle\DistributionBundle\Composer\ScriptHandler as Base;
use Composer\Script\Event;

class ScriptHandler extends Base
{
    public static function createWorkerSecret($event)
    {
        $consoleDir = static::getConsoleDir($event, 'generate worker secret');

        if (null === $consoleDir) {
            return;
        }
        static::executeCommand($event, $consoleDir, 'kami:worker:generate-secret');
    }
}
