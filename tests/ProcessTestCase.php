<?php

use PHPUnit_Framework_TestCase as PHPUnitTestCase;
use Extended\Process\Runnable;
use Extended\Process\Fork;
use Extended\Process\ProcessQueue;

class ProcessTestCase extends PHPUnitTestCase
{
    public function testRunnable()
    {
        $r = new class(5) implements Runnable {
            private $n;

            public function __construct(int $n)
            {
                $this->n = $n;
            }

            public function run()
            {
                return $this->n;
            }
        };

        $this->assertEquals(5, $r->run());
        $this->assertEquals(6, (new $r(6))->run());
    }

    public function testForking()
    {
        $child = new class implements Runnable {
            public function run()
            {
                return "I am the child. ";
            }
        };

        $parent = new class implements Runnable {
            public function run()
            {
                return "I am the parent.";
            }
        };

        $this->assertEquals('I am the child. I am the parent.', (new Fork)->fork($parent, $child));
    }
}
