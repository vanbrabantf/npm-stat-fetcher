<?php

namespace Vanbrabantf\NpmStatFetcher\tests;

use Cake\Chronos\Chronos;
use PHPUnit\Framework\TestCase;
use Vanbrabantf\NpmStatFetcher\Dates\DateException;
use Vanbrabantf\NpmStatFetcher\NpmRegistryRepository;
use Vanbrabantf\NpmStatFetcher\Package\Package;
use Vanbrabantf\NpmStatFetcher\StatFetcher;
use Vanbrabantf\NpmStatFetcher\Statistics\DownloadStatistics;

class StatFetcherTest extends TestCase
{
    /**
     * @test
     */
    public function itCanGetTheDownloadsFromAPackage()
    {
        $now = (new Chronos())->format('Y-m-d');

        $repository = $this->createMock(NpmRegistryRepository::class);
        $repository->method('getResourceByPath')
            ->with('/downloads/point/1999-01-01:' . $now . '/Care')
            ->willReturn('{"downloads":4224631,"start":"2017-09-29","end":"2017-10-05","package":"Care"}');

        $fetcher = new StatFetcher($repository);
        $downloadsStatistics = $fetcher->getDownloads('Care');

        $this->assertTrue($downloadsStatistics instanceof DownloadStatistics);
        $this->assertSame(4224631, $downloadsStatistics->getDownloads());
        $this->assertSame('2017-09-29', $downloadsStatistics->getStartDate()->format('Y-m-d'));
        $this->assertSame('2017-10-05', $downloadsStatistics->getEndDate()->format('Y-m-d'));
        $this->assertSame('Care', $downloadsStatistics->getPackageName());
    }

    /**
     * @test
     */
    public function itCanGetTheDownloadsFromAPackageBetweenTwoDates()
    {
        $start = new Chronos('2017-09-29');
        $end = new Chronos('2017-10-05');

        $repository = $this->createMock(NpmRegistryRepository::class);
        $repository->method('getResourceByPath')
            ->with('/downloads/point/' . $start->format('Y-m-d') . ':' . $end->format('Y-m-d') . '/Care')
            ->willReturn('{"downloads":4224631,"start":"2017-09-29","end":"2017-10-05","package":"Care"}');

        $fetcher = new StatFetcher($repository);
        $downloadsStatistics = $fetcher->getDownloadsBetweenDates('Care', $start, $end);

        $this->assertTrue($downloadsStatistics instanceof DownloadStatistics);
        $this->assertSame(4224631, $downloadsStatistics->getDownloads());
        $this->assertSame('2017-09-29', $downloadsStatistics->getStartDate()->format('Y-m-d'));
        $this->assertSame('2017-10-05', $downloadsStatistics->getEndDate()->format('Y-m-d'));
        $this->assertSame('Care', $downloadsStatistics->getPackageName());
    }

    /**
     * @test
     */
    public function itWillErrorOnInputFromTheFutureOnGettingDownloadsFromAPackageBetweenTwoDates()
    {
        $this->expectException(DateException::class);

        $start = new Chronos('+1 year');
        $end = new Chronos('+2 years');

        $repository = $this->createMock(NpmRegistryRepository::class);
        $repository->method('getResourceByPath')
            ->with('/downloads/point/' . $start->format('Y-m-d') . ':' . $end->format('Y-m-d') . '/Care')
            ->willReturn('{"downloads":4224631,"start":"2017-09-29","end":"2017-10-05","package":"Care"}');

        $fetcher = new StatFetcher($repository);
        $fetcher->getDownloadsBetweenDates('Care', $start, $end);
    }

    /**
     * @test
     */
    public function itCanGetTheDownloadsFromYesterdaysPackage()
    {
        $repository = $this->createMock(NpmRegistryRepository::class);
        $repository->method('getResourceByPath')
            ->with('/downloads/point/last-day/Care')
            ->willReturn('{"downloads":4224631,"start":"2017-09-29","end":"2017-10-05","package":"Care"}');

        $fetcher = new StatFetcher($repository);
        $downloadsStatistics = $fetcher->getDownloadsLastDay('Care');

        $this->assertTrue($downloadsStatistics instanceof DownloadStatistics);
        $this->assertSame(4224631, $downloadsStatistics->getDownloads());
        $this->assertSame('2017-09-29', $downloadsStatistics->getStartDate()->format('Y-m-d'));
        $this->assertSame('2017-10-05', $downloadsStatistics->getEndDate()->format('Y-m-d'));
        $this->assertSame('Care', $downloadsStatistics->getPackageName());
    }

    /**
     * @test
     */
    public function itCanGetTheDownloadsFromYesterweeksPackage()
    {
        $repository = $this->createMock(NpmRegistryRepository::class);
        $repository->method('getResourceByPath')
            ->with('/downloads/point/last-week/Care')
            ->willReturn('{"downloads":4224631,"start":"2017-09-29","end":"2017-10-05","package":"Care"}');

        $fetcher = new StatFetcher($repository);
        $downloadsStatistics = $fetcher->getDownloadsLastWeek('Care');

        $this->assertTrue($downloadsStatistics instanceof DownloadStatistics);
        $this->assertSame(4224631, $downloadsStatistics->getDownloads());
        $this->assertSame('2017-09-29', $downloadsStatistics->getStartDate()->format('Y-m-d'));
        $this->assertSame('2017-10-05', $downloadsStatistics->getEndDate()->format('Y-m-d'));
        $this->assertSame('Care', $downloadsStatistics->getPackageName());
    }

    /**
     * @test
     */
    public function itCanGetTheDownloadsFromYestermonthsPackage()
    {
        $repository = $this->createMock(NpmRegistryRepository::class);
        $repository->method('getResourceByPath')
            ->with('/downloads/point/last-year/Care')
            ->willReturn('{"downloads":4224631,"start":"2016-09-29","end":"2017-10-05","package":"Care"}');

        $fetcher = new StatFetcher($repository);
        $downloadsStatistics = $fetcher->getDownloadsLastYear('Care');

        $this->assertTrue($downloadsStatistics instanceof DownloadStatistics);
        $this->assertSame(4224631, $downloadsStatistics->getDownloads());
        $this->assertSame('2016-09-29', $downloadsStatistics->getStartDate()->format('Y-m-d'));
        $this->assertSame('2017-10-05', $downloadsStatistics->getEndDate()->format('Y-m-d'));
        $this->assertSame('Care', $downloadsStatistics->getPackageName());
    }

    /**
     * @test
     */
    public function itCanGetTheDownloadsFromYesteryearsPackage()
    {
        $repository = $this->createMock(NpmRegistryRepository::class);
        $repository->method('getResourceByPath')
            ->with('/downloads/point/last-year/Care')
            ->willReturn('{"downloads":4224631,"start":"2016-09-29","end":"2017-10-05","package":"Care"}');

        $fetcher = new StatFetcher($repository);
        $downloadsStatistics = $fetcher->getDownloadsLastYear('Care');

        $this->assertTrue($downloadsStatistics instanceof DownloadStatistics);
        $this->assertSame(4224631, $downloadsStatistics->getDownloads());
        $this->assertSame('2016-09-29', $downloadsStatistics->getStartDate()->format('Y-m-d'));
        $this->assertSame('2017-10-05', $downloadsStatistics->getEndDate()->format('Y-m-d'));
        $this->assertSame('Care', $downloadsStatistics->getPackageName());
    }
}
