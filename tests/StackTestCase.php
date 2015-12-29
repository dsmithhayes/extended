<?php

use Extended\Stack;

class StackTestCase extends PHPUnit_Framework_TestCase
{
    public function testStackPop()
    {
        $stack = new Stack([0, 1, 2]);
        $this->assertEquals(2, $stack->pop());
        return $stack;
    }

    /**
     * @depends testStackPop
     */
    public function testStackReset($stack)
    {
        $this->assertEquals(1, $stack->getStackPointer());
        return $stack;
    }

    /**
     * @depends testStackReset
     */
    public function testStackPopAfterPop($stack)
    {
        $this->assertEquals(1, $stack->pop());
        return $stack;
    }
}
