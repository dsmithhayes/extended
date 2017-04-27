<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

namespace Extended\Mutable;

use Extended\Mutable\GetInterface;
use Extended\Mutable\SetInterface;

class Mutable implements GetInterface, SetInterface
{
    /**
     * @var array
     *      The values to represent as object properties
     */
    private $values;

    /**
     * @param string $name
     *      The name of the property
     * @param mixed $value
     *      The value to set for the property within the object
     * @return $this
     */
    public function set($name, $value)
    {
        $this->values[(string) $name] = $value;
        return $this;
    }

    /**
    * @param string $name
    *      The name of the property to get
    * @return mixed
    *      The value of the property
    */
    public function __get(string $name)
    {
        return $this->values[$name];
    }

    /**
     * @param string $name
     *      The name of the property
     * @return mixed
     *      The value of the property
     */
    public function get($name)
    {
        return $this->values[(string) $name];
    }

    /**
     * @param string $name
     *      The name of the property to set
     * @param mixed $value
     *      The value for the property to set
     */
    public function __set(string $name, $value)
    {
        $this->set($name, $value);
    }
}
