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
        // only testes the top of the stack, quits
        foreach ($stack as $s) {
            $this->assertEquals(3, $s);
            break;
        }

        return $stack;
    }

    /**
     * @depends testIteration
     * @expectedException \Extended\Exception\StackException
     */
    public function testReset($stack)
    {
        $stack->reset();
        $stack->pop();

        return $stack;
    }
}
