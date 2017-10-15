<?php

namespace Vanbrabantf\NpmStatFetcher\ValueObjects;

interface StatisticInterface
{
    /**
     * @param Package $package
     * @param string $resource
     * @return StatisticInterface
     */
    public static function fromJson(Package $package, string $resource);
}
