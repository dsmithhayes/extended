<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

namespace Extended;

use Extended\Collections\Queue;

/**
 * Class BasicQueue
 * @package Extended
 */
class BasicQueue implements Queue
{
    protected $data;

    /**
     * BasicQueue constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = array_values($data);
    }

    /**
     * @param mixed $item
     * @return $this
     */
    public function enqueue($item)
    {
        $this->data[] = $item;
        return $this;
    }

    /**
     * @return mixed
     */
    public function dequeue()
    {
        $d = array_shift($this->data);
        $this->data = array_values($this->data);
        return $d;
    }
}