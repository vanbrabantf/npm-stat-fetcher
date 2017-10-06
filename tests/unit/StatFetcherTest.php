<?php

namespace Vanbrabantf\NpmStatFetcher\tests\unit;

use PHPUnit\Framework\TestCase;
use Vanbrabantf\NpmStatFetcher\Repositories\NpmRegistryRepository;
use Vanbrabantf\NpmStatFetcher\StatFetcher;
use Vanbrabantf\NpmStatFetcher\ValueObjects\DownloadStatistics;
use Vanbrabantf\NpmStatFetcher\ValueObjects\Package;

class StatFetcherTest extends TestCase
{
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
}