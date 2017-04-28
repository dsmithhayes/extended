<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

use PHPUnit_Framework_TestCase as PHPUnitTestCase;
use Extended\AdvancedQueue;

class AdvancedQueueTestCase extends PHPUnitTestCase
{
    public function testIteration()
    {
        $q = new AdvancedQueue([1, 2, 3, 4]);

        foreach ($q as $item) {
            $this->assertEquals(1, $item);
            break;
        }

        foreach ($q as $item) {
            $this->assertEquals(2, $item);
            break;
        }
    }
}