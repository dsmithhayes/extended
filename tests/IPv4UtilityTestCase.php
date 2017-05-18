<?php

use PHPUnit_Framework_TestCase as PHPUnitTestCase;
use Extended\IPAddress\{IPv4Utility, IPv4, IPv4NetworkMask};

class IPv4UtilityTestCase extends PHPUnitTestCase
{
    public function testPrivateClassA()
    {
        $ip = '10.0.0.1';
        $this->assertTrue(IPv4Utility::isPrivateClassA($ip));
    }

    public function containsCidr()
    {
        $ip = new IPv4('10.0.0.1/8');
        $this->assertTrue((bool) $ip->getCidr());

        $ip->setAddress('10.0.0.1');
        $this->assertTrue((bool) $ip->getCidr());
    }
}