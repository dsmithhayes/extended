<?php

use PHPUnit_Framework_TestCase as PHPUnitTestCase;

use Extended\IPAddress\{IPv4NetworkMask, IPv4, IPv4Utility};

/**
 * Class IPv4NetworkMaskTestCase
 */
class IPv4NetworkMaskTestCase extends PHPUnitTestCase
{
    /**
     * @param string $class
     * @return array
     */
    public function getAddressPair(string $class)
    {
        $ret = function (string $address, string $mask): array {
            return [
                'address' => $address,
                'mask' => $mask
            ];
        };

        switch ($class) {
            case 'a':
                return $ret('10.0.0.1/8', '255.0.0.0');
            case 'b':
                return $ret('172.16.0.1/16', '255.255.0.0');
            case 'c':
            default:
                return $ret('192.168.0.1/24', '255.255.255.0');
        }
    }

    /**
     * @param array $addressPair
     */
    protected function runClassTests(array $addressPair)
    {
        $ip = new IPv4($addressPair['address']);
        $this->assertTrue($ip->isPrivateAddress());

        $mask = new IPv4NetworkMask(IPv4Utility::cidrToMask($ip->getCidr()));
        $this->assertEquals($addressPair['mask'], $mask->getMaskAddress());
    }

    public function testClassA()
    {
        $a = $this->getAddressPair('a');
        $this->runClassTests($a);
    }

    public function testClassB()
    {
        $b = $this->getAddressPair('b');
        $this->runClassTests($b);
    }

    public function testClassC()
    {
        $c = $this->getAddressPair('c');
        $this->runClassTests($c);
    }
}