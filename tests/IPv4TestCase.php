<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

use PHPUnit_Framework_TestCase as PHPUnitTestCase;
use Extended\IPAddress\IPv4;
use Extended\IPAddress\IPv4Utility;
use Extended\Exception\IPv4Exception;

/**
 * Class IPv4TestCase
 */
class IPv4TestCase extends PHPUnitTestCase
{
    public function testIPv4Utility()
    {
        $valid = '100.100.100.100';
        $invalid = '256.256.256.256';
        $private = '192.168.0.100';
        $withCidr = '192.168.0.0/16';

        $this->assertFalse(IPv4Utility::isPrivateAddress($valid));
        $this->assertTrue(IPv4Utility::isPrivateAddress($private));
        $this->assertTrue(IPv4Utility::containsCidr($withCidr));

        $parts = explode('.', $invalid);
        $this->assertFalse(IPv4Utility::isValidOctet($parts[0]));

        $this->assertEquals('255.0.0.0', IPv4Utility::cidrToMask(8));
        $this->assertEquals(8, IPv4Utility::maskToCidr('255.0.0.0'));
    }

    public function testIPv4SetAddress()
    {
        $ipAddress = new IPv4('172.16.0.1');
        $this->assertEquals(172, $ipAddress->getOctets()[0]);

        $ipAddress = new IPv4('172.16.0.1/24');
        $this->assertEquals(1, $ipAddress->getOctets()[3]);

        $ipAddress = new IPv4();
        $this->assertEquals('127.0.0.1', $ipAddress->getAddress());

        $this->assertTrue($ipAddress->isPrivateAddress());
    }

    /**
     * @expectedException \Extended\Exception\IPv4Exception
     */
    public function testInvalidIPv4()
    {
        $ipAddress = new IPv4('256.256.256.256');
    }

    /**
     * @expectedException \Extended\Exception\IPv4Exception
     */
    public function testInvalidIPv4Negative()
    {
        $ipAddress = new IPv4('-2.-5.0.0');
    }
}