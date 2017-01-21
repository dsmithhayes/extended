<?php

use PHPUnit_Framework_TestCase as PHPUnitTestCase;
use Extended\Stream\Buffer\OutputBuffer;

class OutputBufferTest extends PHPUnitTestCase
{
    public function testOutputBuffer()
    {
        $ob = new OutputBuffer();

        $ob->start();
?>
Hello, world.<?php
        $this->assertEquals("Hello, world.", $ob->output());
        $ob->endClean();

        $ob->start();
        echo "hello.";
        $this->assertEquals("hello.", $ob->output());
        $ob->endClean();
    }
}
