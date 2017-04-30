<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

namespace Extended\IPAddress;

use Extended\IPAddress\IPv4Utility;
use Extended\Exception\IPv4Exception;

/**
 * Class IPv4
 * @package Extended\IPAddress
 */
class IPv4
{
    /**
     * @var string
     */
    const LOOPBACK_ADDR = '127.0.0.1';

    /**
     * @var int
     */
    const MAX_OCTET = 255;

    /**
     * var int
     */
    const MIN_OCTET = 0;

    /**
     * @var array
     */
    protected $octets;

    /**
     * @var bool
     */
    protected $private = false;

    /**
     * IPv4 constructor.
     * @param string $address
     */
    public function __construct(string $address = '127.0.0.1')
    {
        $this->octets = $this->parseOctets($address);
        $this->private = IPv4Utility::isPrivateAddress($address);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getAddress();
    }

    /**
     * @return array
     */
    public function getOctets(): array
    {
        return $this->octets;
    }

    /**
     * @param string $address
     * @return $this
     */
    public function setAddress(string $address)
    {
        $this->octets = $this->parseOctets($address);
        $this->private = IPv4Utility::isPrivateAddress($address);
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return implode('.', $this->octets);
    }

    /**
     * @return bool
     */
    public function isPrivateAddress(): bool
    {
        return $this->private;
    }

    /**
     * @param string $address
     * @return array
     * @throws IPv4Exception
     */
    public function parseOctets(string $address): array
    {
        $octets = IPv4Utility::parseOctets($address);

        // Strip the CIDR
        if (IPv4Utility::containsCidr($address)) {
            list($octets[3]) = explode('/', $octets[3]);
        }

        foreach ($octets as $octet) {
            if (!IPv4Utility::isValidOctet($octet)) {
                throw new IPv4Exception("Invalid octet: {$octet}.");
            }
        }

        return $octets;
    }

    /**
     * @return int
     */
    public function toLong(): int
    {
        return ip2long($this->getAddress());
    }
}