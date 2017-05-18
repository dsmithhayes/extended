<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

namespace Extended\Collections\Queue;

use Extended\Stream\Message;
use Extended\BasicQueue;

/**
 * Class MessageQueue
 * @package Extended\Collections\Queue
 */
class MessageQueue extends BasicQueue
{
    protected $messages;

    /**
     * Every value of the array must extend the \Extended\Stream\Message.
     *
     * MessageQueue constructor.
     */
    public function __construct(array $q = [])
    {
        if (!empty($q)) {
            foreach ($q as $message) {
                if (!$this->isMessage($message)) {
                    throw new \Exception("Invalid value: {$message}");
                }
            }
        }

        parent::__construct($q);
    }

    /**
     * @param $value
     * @return bool
     */
    protected function isMessage($value): bool
    {
        return $value instanceof Message;
    }
}