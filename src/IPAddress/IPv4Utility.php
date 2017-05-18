<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

namespace Extended\IPAddress;

use Extended\IPAddress\IPv4;

/**
 * Class IPv4Utility
 * @package Extended\IPAddress
 */
class IPv4Utility
{
    /**
     * @var int
     */
    const MIN_OCTET = 0;

    /**
     * @var int
     */
    const MAX_OCTET = 255;

    /**
     * @param string $address
     * @return bool
     */
    public static function isPrivateClassA(string $address): bool
    {
        return (bool) (substr($address, 0, 3) === '10.');
    }

    /**
     * @param string $address
     * @return bool
     */
    public static function isPrivateClassB(string $address): bool
    {
        return (bool) (preg_match('/172\.(1[6-9]|2[0-9]|3[0-2])\./', $address));
    }

    /**
     * @param string $address
     * @return bool
     */
    public static function isPrivateClassC(string $address): bool
    {
        return (bool) (substr($address, 0, 8) === '192.168.');
    }

    /**
     * @param string $address
     * @return bool
     */
    public static function isLoopbackAddress(string $address): bool
    {
        return (bool) (substr($address, 0, 4) === '127.');
    }

    /**
     * @param string $address
     * @return bool
     */
    public static function isPrivateAddress(string $address ): bool
    {
        if (self::isPrivateClassA($address)) {
            return true;
        }

        if (self::isPrivateClassB($address)) {
            return true;
        }

        if (self::isPrivateClassC($address)) {
            return true;
        }

        if (self::isLoopbackAddress($address)) {
            return true;
        }

        return false;
    }

    /**
     * @param int $octet
     * @return bool
     */
    public static function isValidOctet(int $octet): bool
    {
        return (bool) ($octet >= self::MIN_OCTET && $octet <= self::MAX_OCTET);
    }

    /**
     * @param int $octet
     * @return int
     */
    public static function floorOctet(int $octet): int
    {
        return ($octet < self::MIN_OCTET) ? self::MIN_OCTET : $octet;
    }

    /**
     * @param int $octet
     * @return int
     */
    public static function ceilOctet(int $octet): int
    {
        return ($octet > self::MIN_OCTET) ? self::MAX_OCTET : $octet;
    }

    /**
     * @param string $address
     * @return array
     */
    public static function parseOctets(string $address): array
    {
        if (self::containsCidr($address)) {
            $address = preg_replace('/\/\d+/', '', $address);
        }

        $address = explode('.', $address);
        $address = array_slice($address, 0, 4);
        $address = array_map(function ($v) {
            return intval($v);
        }, $address);

        return $address;
    }

    /**
     * @param string $mask
     * @return int
     */
    public static function maskToCidr(string $mask): int
    {
        $octets = self::parseOctets($mask);
        $binary = '';
        foreach ($octets as $octet) {
            $binary .= decbin($octet);
        }

        $total = 0;

        foreach (str_split($binary) as $bit) {
            if ($bit === '0') {
                break;
            }

            ++$total;
        }

        return $total;
    }

    /**
     * @param int $cidr
     * @return string
     */
    public static function cidrToMask(int $cidr): string
    {
        $maskBin = '';

        for ($i = 0; $i < 32; $i++) {
            if ($i % 8 === 0) {
                $maskBin .= '.';
            }

            $maskBin = (($i < $cidr) ? '1' : '0') . $maskBin;
        }

        $octetsBin = explode('.', $maskBin);
        $octetsBin = array_slice($octetsBin, 0, 4);

        foreach ($octetsBin as $octet) {
            $octets[] = bindec($octet);
        }

        return implode('.', $octets);
    }

    /**
     * @param string $address
     * @return int
     */
    public static function parseCidr(string $address): int
    {
        if (!self::containsCidr($address)) {
            return 0;
        }

        $last = explode('.', $address)[3];
        $cidr = preg_split('/\//', $last)[1];
        return (int) $cidr;
    }

    /**
     * @param string $address
     * @return bool
     */
    public static function containsCidr(string $address): bool
    {
        $last = explode('.', $address)[3];
        return (bool) (preg_match('/\/\d+/', $last));
    }

    /**
     * @param string $address
     * @return int
     */
    public static function addressToLong(string $address): int
    {
        return ip2long($address);
    }

    /**
     * @param int $long
     * @return string
     */
    public static function longToAddress(int $long): string
    {
        return long2ip($long);
    }
}