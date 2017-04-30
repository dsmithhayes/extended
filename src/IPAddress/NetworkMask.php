<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

namespace Extended\IPAddress;

/**
 * Class NetworkMask
 * @package Extended\IPAddress
 */
abstract class NetworkMask
{
    /**
     * This method implies the internally stored mask will be applied against
     * the address supplied as a parameter.
     *
     * @param string $address
     * @return string
     */
    abstract public function mask(string $address): string;
}