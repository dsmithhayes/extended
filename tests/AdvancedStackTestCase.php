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
}
