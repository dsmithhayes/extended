<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */
namespace Extended\Exception;

/**
 * Class StackException
 * @package Extended\Exception
 */
class StackException extends \Exception
{
    /**
     * @var int
     *      Error code for when the stack is empty
     */
    const STACK_EMPTY = 0;
}
