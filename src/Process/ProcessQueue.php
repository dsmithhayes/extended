<?php

namespace Extended\Process;

use Extended\Collections\Queue;
use Extended\Process\Runnable;
use Exteneded\Exception\ProcessException;

class ProcessQueue implements Queue
{
    private $processes;

    /**
     * @param array $processes
     *      An array of implemented Runnable objects
     */
    public function __construct(array $processes = [])
    {
        $this->enqueueMany($processes);
    }

    /**
     * @param Extended\Process\Runnable $process
     *      A process to enqueue
     */
    public function enqueue($process)
    {
        if ($process instanceof Runnable) {
            $this->processes[] = $process;
            return $this;
        }

        throw new ProcessException('Adding non-Runnable to ProcessQueue.');
    }

    /**
     * @param array $processes
     *      An array of Runnable objects to add to the queue
     */
    public function enqueueMany(array $processes)
    {
        $f = function () use ($processes) {
            foreach ($processes as $p) {
                if ($p instanceof Runnable) {
                    yield $p;
                }
            }
        };

        foreach ($f() as $p) {
            $this->enqueue($p);
        }

        return $this;
    }

    /**
     * @return Extended\Process\Runnable
     */
    public function dequeue(): Runnable
    {
        return array_shift($this->processes);
    }

    /**
     * @yield Extended\Process\Runnable;
     */
    public function dequeueAll()
    {
        foreach ($this->processes as $p) {
            yield $p;
        }
    }

    /**
     * Runs the next process
     */
    public function runNext()
    {
        return $this->dequeue()->run();
    }
}
