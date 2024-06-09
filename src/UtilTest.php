<?php

namespace Core;
require __DIR__ . '/vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class UtilTest extends TestCase
{
    private $util;

    protected function setUp(): void
    {
        $this->util = new Util();
    }

    public function testIsNeighbour()
    {
        $this->assertTrue($this->util->isNeighbour('1,1', '1,2'));
        $this->assertTrue($this->util->isNeighbour('1,1', '2,1'));
        $this->assertFalse($this->util->isNeighbour('1,1', '3,3'));
    }
}