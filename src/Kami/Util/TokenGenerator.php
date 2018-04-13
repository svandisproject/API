<?php


namespace Kami\Util;

use RandomLib\Factory;
use SecurityLib\Strength;

class TokenGenerator
{
    /**
     * Generate token of given length
     *
     * @param int $length
     * @return string
     */
    public static function generate($length)
    {
        $factory = new Factory;
        $generator = $factory->getGenerator(new Strength(Strength::MEDIUM));

        return $generator->generateString(
            $length, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
        );
    }
}