<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

namespace Extended\Immutable;

use Extended\Mutable\GetInferace;
use Extended\Immutable\ImmutableInterface;
use Extended\Traits\DeepCopyTrait;
use Extended\Exception\ImmutableException;

/**
 * Class Immutable
 * @package Extended\Immutable
 */
class Immutable implements ImmutableInterface
{
    use DeepCopyTrait;

    /**
     * @var mixed
     *      The value of the object
     */
    private $value;

    /**
     * @param array $value
     *      The value for the obect with the key
     */
    public function __construct($value)
    {
        $this->value = $value;
    }


    /**
     * @param mixed $key
     *      The name of the value in the object
     * @return mixed
     *      The value
     */
    public function get($key)
    {
        return $this->deepCopy($this->value[$key]);
    }

    /**
     * This method will make the use of calling the value directly from the
     * object.
     *
     *      $imm = new Immutable(['value' => 'key']);
     *      $imm->value;
     *
     * @see \Extended\Immutable\Immtubale::get
     */
    public function __get($key)
    {
        return $this->get($key);
    }

    /**
     * Trying to change immutable data is met with an exception.
     *
     * @param string $key
     * @param mixed $value
     * @throws \Extended\Exception\ImmutableException
     *      This exception is always thrown when trying to set the values inside
     *      this data structure.
     */
    public function __set($key, $value)
    {
        throw new ImmutableException('Unable to set value.');
    }
}
