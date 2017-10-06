<?php

namespace Vanbrabantf\NpmStatFetcher\Tests\unit\ValueObjects;

use PHPUnit\Framework\TestCase;
use Vanbrabantf\NpmStatFetcher\ValueObjects\Package;
use Vanbrabantf\NpmStatFetcher\ValueObjects\Statistics;

class StatisticsTest extends TestCase
{
    /**
     * @test
     */
    public function itCanGetThePackageNameFromABaseStatistic()
    {
        $package = new Package('care');
        $statistic = new Statistics($package);

        $this->assertSame('care', $statistic->getPackageName());
    }

    /**
     * @test
     */
    public function itCanGetThePackageFromABaseStatistic()
    {
        $package = new Package('care');
        $statistic = new Statistics($package);

        $this->assertSame('care', (string) $statistic->getPackage());
    }
}