<?php

namespace Vanbrabantf\NpmStatFetcher\Tests\Statistics;

use PHPUnit\Framework\TestCase;
use Vanbrabantf\NpmStatFetcher\Package\Package;
use Vanbrabantf\NpmStatFetcher\Statistics\Statistics;

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
