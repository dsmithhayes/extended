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

        if (IPv4Utility::isPrivateAddress($address)) {
            $this->private = true;
        }
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
     * @param string $address
     * @param null $cidr
     * @return array
     * @throws IPv4Exception
     */
    public function parseOctets(string $address, &$cidr = null): array
    {
        $octets = explode('.', $address);
        $octets = array_slice($octets, 0, 4);

        // Catch the CIDR
        if (preg_match('/\/\d+/', $octets[3])) {
            list($octets[3], $cidr) = explode('/', $octets[3]);
        }

        $octets = array_map(function ($v): int {
            return (int)$v;
        }, $octets);

        foreach ($octets as $octet) {
            if (!IPv4Utility::isValidOctet($octet)) {
                throw new IPv4Exception("Invalid octet: {$octet}.");
            }
        }

        return $octets;
    }
}