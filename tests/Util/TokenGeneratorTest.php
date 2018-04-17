<?php

namespace Tests\Util;

use Kami\Util\TokenGenerator;
use PHPUnit\Framework\TestCase;

class TokenGeneratorTest extends TestCase
{
    public function testGenerate()
    {
        $this->assertEquals(10, strlen(TokenGenerator::generate(10)));
    }
}
