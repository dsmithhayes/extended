<?php

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

use PHPUnit_Framework_TestCase as PHPUnitTestCase;
use Extended\IPAddress\IPv4;

/**
 * Class IPv4TestCase
 */
class IPv4TestCase extends PHPUnitTestCase
{
    public function testIPv4SetAddress()
    {
        $ipAddress = new IPv4('172.16.0.1');
        $this->assertEquals(172, $ipAddress->getOctets()[0]);

        $ipAddress = new IPv4('172.16.0.1/24');
        $this->assertEquals(1, $ipAddress->getOctets()[3]);

        $ipAddress = new IPv4();
        $this->assertEquals('127.0.0.1', $ipAddress->getAddress());
    }
}