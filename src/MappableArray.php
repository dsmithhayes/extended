<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

namespace Extended;

use ArrayAccess;
use Extended\Collections\Mappable;
use Extended\Collections\InlineMappable;
use Extended\Exception\MappableException;

/**
 * Class MappableArray
 * @package Extended
 */
class MappableArray implements ArrayAccess, Mappable, InlineMappable
{
    /**
     * @var array
     */
    protected $store;

    /**
     * MappableArray constructor.
     * @param array $arr
     */
    public function __construct(array $arr = [])
    {
        $this->store = $arr;
    }

    /**
     * @return array
     */
    public function __invoke()
    {
        return $this->store;
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->store);
    }

    /**
     * @param mixed $offset
     * @return mixed
     * @throws MappableException
     */
    public function offsetGet($offset)
    {
        if (!$this->offsetExists($offset)) {
            throw new MappableException("Array key: '{$offset}' does not exist.");
        }

        return $this->store[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     * @return $this
     * @throws MappableException
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($this->store[$offset])) {
            $this->store[] = $value;
        } else {
            $this->store[$offset] = $value;
        }

        return $this;
    }

    /**
     * @param mixed $offset
     * @return $this
     * @throws MappableException
     */
    public function offsetUnset($offset)
    {
        if (!$this->offsetExists($offset)) {
            throw new MappableException("Array key: '{$offset}' does not exist.");
        }

        unset($this->store[$offset]);
        return $this;
    }

    /**
     * @param callable $callback
     * @return array
     */
    public function map(callable $callback): array
    {
        $tmp = [];

        foreach ($this->store as $key => $value) {
            $tmp[$key] = $callback($value);
        }

        return $tmp;
    }

    /**
     * @param callable $callback
     * @return array
     */
    public function inlineMap(callable $callback): array
    {
        foreach ($this->store as $key => $value) {
            $this->store[$key] = $callback($value);
        }

        return $this->store;
    }
}