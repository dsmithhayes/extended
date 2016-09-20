<?php

namespace Extended\Mutable;

use Extended\Mutable\GetInterface;
use Extended\Mutable\SetInterface;

abstract class Mutable implements GetInterface, SetInterface
{
    /**
     * @var array
     *      The values to represent as object properties
     */
    private $values;

    /**
     * @param string $key
     *      The name of the property
     * @param mixed $value
     *      The value to set for the property within the object
     */
    public function set(string $name, $value)
    {
        $this->values[$name] = $value;
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
     * @param string $key
     *      The name of the property
     * @return mixed
     *      The value of the property
     */
    public function get(string $name)
    {
        return $this->values[$name];
    }

    public function __set(string $name, $value)
    {
        $this->set($name, $value);
    }
}
