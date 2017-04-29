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
        return (bool) ($octet >= self::MIN_OCTET || $octet <= self::MAX_OCTET);
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
}