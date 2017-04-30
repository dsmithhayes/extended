<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

namespace Extended\IPAddress;

use Extended\IPAddress\NetworkMask;
use Extended\IPAddress\IPv4Utility;

class IPv4NetworkMask extends NetworkMask
{
    public function __construct(string $address)
    {
        $this->mask = $address;
    }

    /**
     * @param string $mask
     * @return string
     */
    public function mask(string $mask): string
    {

    }
}