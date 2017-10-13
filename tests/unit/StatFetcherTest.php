<?php

namespace Vanbrabantf\NpmStatFetcher\tests\unit;

use Cake\Chronos\Chronos;
use PHPUnit\Framework\TestCase;
use Vanbrabantf\NpmStatFetcher\Exceptions\DateException;
use Vanbrabantf\NpmStatFetcher\Repositories\NpmRegistryRepository;
use Vanbrabantf\NpmStatFetcher\StatFetcher;
use Vanbrabantf\NpmStatFetcher\ValueObjects\DownloadStatistics;
use Vanbrabantf\NpmStatFetcher\ValueObjects\Package;

class StatFetcherTest extends TestCase
{
    /**
     * @test
     */
    public function itCanGetTheDownloadsFromAPackage()
    {
        $now = (new Chronos())->format('Y-m-d');

        $package = new Package('Care');
        $repository = $this->createMock(NpmRegistryRepository::class);
        $repository->method('getResourceByPath')
            ->with('/downloads/point/1999-01-01:' . $now . '/Care')
            ->willReturn('{"downloads":4224631,"start":"2017-09-29","end":"2017-10-05","package":"Care"}');

        $fetcher = new StatFetcher($package, $repository);
        $downloadsStatistics = $fetcher->getDownloads();

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

        $package = new Package('Care');
        $repository = $this->createMock(NpmRegistryRepository::class);
        $repository->method('getResourceByPath')
            ->with('/downloads/point/' . $start->format('Y-m-d') . ':' . $end->format('Y-m-d') . '/Care')
            ->willReturn('{"downloads":4224631,"start":"2017-09-29","end":"2017-10-05","package":"Care"}');

        $fetcher = new StatFetcher($package, $repository);
        $downloadsStatistics = $fetcher->getDownloadsBetweenDates($start, $end);

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

        $package = new Package('Care');
        $repository = $this->createMock(NpmRegistryRepository::class);
        $repository->method('getResourceByPath')
            ->with('/downloads/point/' . $start->format('Y-m-d') . ':' . $end->format('Y-m-d') . '/Care')
            ->willReturn('{"downloads":4224631,"start":"2017-09-29","end":"2017-10-05","package":"Care"}');

        $fetcher = new StatFetcher($package, $repository);
        $fetcher->getDownloadsBetweenDates($start, $end);
    }

    /**
     * @test
     */
    public function itCanGetTheDownloadsFromYesterdaysPackage()
    {
        $package = new Package('Care');
        $repository = $this->createMock(NpmRegistryRepository::class);
        $repository->method('getResourceByPath')
            ->with('/downloads/point/last-day/Care')
            ->willReturn('{"downloads":4224631,"start":"2017-09-29","end":"2017-10-05","package":"Care"}');

        $fetcher = new StatFetcher($package, $repository);
        $downloadsStatistics = $fetcher->getDownloadsLastDay();

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
        $package = new Package('Care');
        $repository = $this->createMock(NpmRegistryRepository::class);
        $repository->method('getResourceByPath')
            ->with('/downloads/point/last-week/Care')
            ->willReturn('{"downloads":4224631,"start":"2017-09-29","end":"2017-10-05","package":"Care"}');

        $fetcher = new StatFetcher($package, $repository);
        $downloadsStatistics = $fetcher->getDownloadsLastWeek();

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
        $package = new Package('Care');
        $repository = $this->createMock(NpmRegistryRepository::class);
        $repository->method('getResourceByPath')
            ->with('/downloads/point/last-year/Care')
            ->willReturn('{"downloads":4224631,"start":"2016-09-29","end":"2017-10-05","package":"Care"}');

        $fetcher = new StatFetcher($package, $repository);
        $downloadsStatistics = $fetcher->getDownloadsLastYear();

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
        $package = new Package('Care');
        $repository = $this->createMock(NpmRegistryRepository::class);
        $repository->method('getResourceByPath')
            ->with('/downloads/point/last-year/Care')
            ->willReturn('{"downloads":4224631,"start":"2016-09-29","end":"2017-10-05","package":"Care"}');

        $fetcher = new StatFetcher($package, $repository);
        $downloadsStatistics = $fetcher->getDownloadsLastYear();

        $this->assertTrue($downloadsStatistics instanceof DownloadStatistics);
        $this->assertSame(4224631, $downloadsStatistics->getDownloads());
        $this->assertSame('2016-09-29', $downloadsStatistics->getStartDate()->format('Y-m-d'));
        $this->assertSame('2017-10-05', $downloadsStatistics->getEndDate()->format('Y-m-d'));
        $this->assertSame('Care', $downloadsStatistics->getPackageName());
    }
}
