<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

namespace Extended\IPAddress;

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

    protected $private = false;

    /**
     * IPv4 constructor.
     * @param string $address
     */
    public function __construct(string $address = '127.0.0.1')
    {
        $this->octets = $this->parseOctets($address);

        if ($this->isPrivateAddress($address)) {
            $this->private = true;
        }
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
     * @return array
     * @throws \Exception
     */
    public function parseOctets(string $address): array
    {
        $octets = explode('.', $address);
        $octets = array_slice($octets, 0, 4);

        // Catch the CIDR
        if (preg_match('/\/\d+/', $octets[3])) {
            list($octets[3]) = explode('/', $octets[3]);
        }

        $octets = array_map(function ($v): int {
            return (int)$v;
        }, $octets);

        foreach ($octets as $octet) {
            if (!$this->isValidOctet($octet)) {
                throw new \Exception($octet);
            }
        }

        return $octets;
    }

    /**
     * @param string $address
     * @return bool
     */
    public function isPrivateClassA(string $address): bool
    {
        return (bool) (substr($address, 0, 3) === '10.');
    }

    /**
     * @param string $address
     * @return bool
     */
    public function isPrivateClassB(string $address): bool
    {
        return (bool) (preg_match('/172\.(1[6-9]|2[0-9]|3[0-2])\./', $address));
    }

    /**
     * @param string $address
     * @return bool
     */
    public function isPrivateClassC(string $address): bool
    {
        return (bool) (substr($address, 0, 8) === '192.168.');
    }

    /**
     * @param string $address
     * @return bool
     */
    public function isPrivateAddress(string $address = ''): bool
    {
        if (!$address) {
            return $this->private;
        }

        if ($this->isPrivateClassA($address)) {
            return true;
        }

        if ($this->isPrivateClassB($address)) {
            return true;
        }

        if ($this->isPrivateClassC($address)) {
            return true;
        }

        return false;
    }

    /**
     * @param int $octet
     * @return bool
     */
    public function isValidOctet(int $octet): bool
    {
        return (bool) ($octet >= self::MIN_OCTET || $octet <= self::MAX_OCTET);
    }
}