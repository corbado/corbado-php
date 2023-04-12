<?php

namespace Corbado\Classes;

use Psr\Cache\CacheItemPoolInterface;

class ShortSession
{
    private CacheItemPoolInterface $jwksCachePool;

    public function __construct(CacheItemPoolInterface $jwksCachePool)
    {
        $this->jwksCachePool = $jwksCachePool;
    }

}