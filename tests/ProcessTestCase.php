<?php

use PHPUnit_Framework_TestCase as PHPUnitTestCase;
use Extended\Process\Runnable;
use Extended\Process\Fork;
use Extended\Process\ProcessQueue;

class ProcessTestCase extends PHPUnitTestCase
{
    /**
     * Makes sure the runnable command can be run
     */
    public function testRunnable()
    {
        /**
         * Build the class that implements a valid runnable process
         */
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

        /**
         * '5' is set explicitly in the anonymous function
         */
        $this->assertEquals(5, $r->run());

        /**
         * We instantiate a new process with a new value
         */
        $this->assertEquals(6, (new $r(6))->run());
    }

    /**
     * Tests running children processes, along with clearing the STDOUT buffer
     * of all of the children.
     */
    public function testForking()
    {
        /**
         * Extremely basic child process
         */
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

    /**
     * Tests a process queue and running all of the processes as seperate
     * children from the main process, but collects the buffer.
     */
    public function testProcessQueue()
    {
        $r = new class(1) implements Runnable {
            private $x;

            public function __construct($x) {
                $this->x = $x;
            }

            public function run()
            {
                return $this->x;
            }
        };

        $q = new ProcessQueue([
            $r,
            (new $r(2))
        ]);

        $f = new Fork();

        foreach ($q->dequeueAll() as $p) {
            $f->fork($p);
        }

        $this->assertEquals(12, $f->getBuffer());

        $q->enqueue((new $r(3)))
          ->enqueue((new $r(4)))
          ->enqueue((new $r(5)));

        $f->clearBuffer();

        foreach ($q->dequeueAll() as $p) {
            $f->fork($p);
        }

        $this->assertEquals(12345, $f->getBuffer());
    }

    public function testRunNext()
    {
        $r = new class(0) implements Runnable {
            private $i;

            public function __construct(int $i)
            {
                $this->i = $i;
            }

            public function run()
            {
                return $this->i;
            }
        };

        $processQueue = new ProcessQueue([
            $r,
            (new $r(1)),
        ]);

        $output = $processQueue->runNext();
        $this->assertEquals(0, $output);
        $output = $processQueue->runNext();
        $this->assertEquals(1, $output);
    }
}
