<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

namespace Extended\IPAddress;

use Extended\Exception\IPv4Exception;
use Extended\IPAddress\NetworkMask;
use Extended\IPAddress\IPv4Utility;
use Extended\IPAddress\IPv4;

/**
 * Class IPv4NetworkMask
 * @package Extended\IPAddress
 */
class IPv4NetworkMask extends NetworkMask
{
    /**
     * @var IPv4
     */
    private $mask;

    /**
     * @var array
     */
    private $octets;

    /**
     * @var int
     */
    private $cidr;

    /**
     * IPv4NetworkMask constructor.
     * @param string $address
     */
    public function __construct(string $address)
    {
        $this->mask = new IPv4($address);
        $this->octets = $this->mask->getOctets();
        $this->cidr = IPv4Utility::maskToCidr($this->mask->getAddress());
    }

    /**
     * @return \Extended\IPAddress\IPv4
     */
    public function getMask(): IPv4
    {
        return $this->mask;
    }

    /**
     * @return string
     */
    public function getMaskAddress(): string
    {
        return $this->mask->getAddress();
    }

    /**
     * @return int
     */
    public function getMaskLong(): int
    {
        return $this->mask->toLong();
    }

    /**
     * @param string $address
     * @return string
     */
    public function mask(string $address): string
    {
        $address = new IPv4($address);
        return IPv4Utility::longToAddress($this->getMaskLong() & $address->toLong());
    }
}