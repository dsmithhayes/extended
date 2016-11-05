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
                return "I am the child.";
            }
        };

        $f = new Fork();
        $f->fork($child);
        $bufferedOutput = $f->getBuffer();
        $this->assertEquals('I am the child.', $bufferedOutput);

        // Static buffer that never changes.
        $f->fork($child);

        $bufferedOutput = $f->getBuffer();
        $this->assertEquals('I am the child.I am the child.', $bufferedOutput);

        $f->clearBuffer();
        $f->fork($child);

        $bufferedOutput = $f->getBuffer();
        $this->assertEquals('I am the child.', $bufferedOutput);
    }

    public function testProcessQueue()
    {
        $first = new class implements Runnable {
            public function run()
            {
                return 1;
            }
        };

        $second = new class implements Runnable {
            public function run()
            {
                return 2;
            }
        };

        $q = new ProcessQueue([$first, $second]);
        $f = new Fork();

        foreach ($q->dequeueAll() as $p) {
            $f->fork($p);
        }

        $this->assertEquals(12, $f->getBuffer());
    }
}
