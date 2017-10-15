<?php

namespace Vanbrabantf\NpmStatFetcher\Statistics;

use Vanbrabantf\NpmStatFetcher\Package\Package;

interface StatisticInterface
{
    /**
     * @param Package $package
     * @param string $resource
     *
     * @return StatisticInterface
     */
    public static function fromJson(Package $package, string $resource);
}
