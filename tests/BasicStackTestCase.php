<?php

use Extended\BasicStack;

class BasicStackTestCase extends PHPUnit_Framework_TestCase
{
    public function testBasicStackPop()
    {
        $stack = new BasicStack([0, 1, 2, 3]);
        $this->assertEquals(3, $stack->pop());
        return $stack;
    }

    /**
     * @depends testBasicStackPop
     */
    public function testBasicStackPush($stack)
    {
        $stack->push(3);
        $this->assertEquals(3, $stack->pop());
        return $stack;
    }
}
