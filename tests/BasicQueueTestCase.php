<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

use PHPUnit_Framework_TestCase as PHPUnitTestCase;
use Extended\BasicQueue;

class BasicQueueTestCase extends PHPUnitTestCase
{
    public function testQueue()
    {
        $q = new BasicQueue([1, 2, 3, 4]);

        $this->assertEquals(1, $q->dequeue());
        $this->assertEquals(2, $q->dequeue());

        $q->enqueue(5);
        $this->assertEquals(3, $q->dequeue());
    }
}