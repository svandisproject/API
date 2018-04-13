<?php

namespace Tests\Util;

use Kami\Util\TokenGenerator;

class TokenGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerate()
    {
        $this->assertEquals(10, strlen(TokenGenerator::generate(10)));
    }
}
