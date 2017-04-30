<?php

namespace Extended\IPAddress;

abstract class NetworkMask
{
    /**
     * @var string
     */
    protected $mask;

    /**
     * @var array
     */
    protected $maskOctets;

    /**
     * @var array
     */
    protected $cidr;

    public function __construct(string $mask)
    {
        $this->mask = $mask;
    }

    /**
     * @param string $address
     * @return string
     */
    abstract public function mask(string $address): string;
}