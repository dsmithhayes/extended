<?php

namespace Extended\Immutable;

use Extended\Mutable\GetInferace;
use Extended\Immutable\ImmutableInterface;

class Immutable implements ImmutableInterface
{
    /**
     * @var array
     *      The value of the object
     */
    private $values;

    /**
     * @param array $values
     *      The values for the obect with the key
     */
    public function __construct(array $values)
    {
        $this->values = $values;
    }

    /**
     * @param mixed $key
     *      The name of the values in the object
     * @return mixed
     *      The value
     */
    public function get($key)
    {
        return $this->values[$key];
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
     * Does nothing if you try and set an immutable value
     *
     * @param string $key
     *      The name of the property within the object
     * @param string $value
     *      The value to set, and immediately discard
     */
    public function __set($key, $value)
    {
        return null;
    }
}
