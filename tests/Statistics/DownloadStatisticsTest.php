<?php

namespace Vanbrabantf\NpmStatFetcher\Tests\Statistics;

use Cake\Chronos\Chronos;
use PHPUnit\Framework\TestCase;
use Vanbrabantf\NpmStatFetcher\Package\Package;
use Vanbrabantf\NpmStatFetcher\Statistics\DownloadStatistics;

class DownloadStatisticsTest extends TestCase
{
    /**
     * @test
     */
    public function itCanCreateADownloadStatistic()
    {
        $package = new Package('Care');
        $downloadStatistic = new DownloadStatistics(
            $package,
            13,
            new Chronos('1989-12-13T00:00:00+00:00'),
            new Chronos('1988-11-07T00:00:00+00:00')
        );

        $this->assertEquals('Care', $downloadStatistic->getPackageName());
        $this->assertEquals(13, $downloadStatistic->getDownloads());
        $this->assertEquals('13', (string) $downloadStatistic);
        $this->assertEquals('1988-11-07T00:00:00+00:00', $downloadStatistic->getEndDate()->format('c'));
        $this->assertEquals('1989-12-13T00:00:00+00:00', $downloadStatistic->getStartDate()->format('c'));
    }

    /**
     * @test
     */
    public function itCanCreateADownloadStatisticFromJson()
    {
        $package = new Package('Care');
        $downloadStatistic = DownloadStatistics::fromJson(
            $package,
            '{"downloads":13,"start":"1989-12-13T00:00:00+00:00","end":"1988-11-07T00:00:00+00:00","package":"react"}'
        );

        $this->assertEquals('Care', $downloadStatistic->getPackageName());
        $this->assertEquals(13, $downloadStatistic->getDownloads());
        $this->assertEquals('13', (string) $downloadStatistic);
        $this->assertEquals('1988-11-07T00:00:00+00:00', $downloadStatistic->getEndDate()->format('c'));
        $this->assertEquals('1989-12-13T00:00:00+00:00', $downloadStatistic->getStartDate()->format('c'));
    }
}
