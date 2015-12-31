<?php

use Extended\AdvancedStack;

class AdvancedStackTestCase extends PHPUnit_Framework_TestCase
{
    public function testAdvancedStackPointer()
    {
        $stack = new AdvancedStack([0, 1, 2, 3]);
        $this->assertEquals(3, $stack->key());
        return $stack;
    }

    /**
     * @depends testAdvancedStackPointer
     */
    public function testIteration($stack)
    {
        foreach ($stack as $s) {
            $this->assertEquals(3, $s);
            break;
        }

        return $stack;
    }

    /**
     * @depends testIteration
     */
    public function testSetPointer($stack)
    {
        $stack->setPointer(0);
        $this->assertEquals(0, $stack->pop());

        return $stack;
    }

    /**
     * @depends testSetPointer
     */
    public function testIncrementPointer($stack)
    {
        $stack->incrementPointer();
        $this->assertEquals(1, $stack->pop());

        return $stack;
    }

    /**
     * @depends testIncrementPointer
     * @expectedException \Extended\Exception\StackException
     */
    public function testReset($stack)
    {
        $stack->reset();
        $stack->pop();

        return $stack;
    }
}
