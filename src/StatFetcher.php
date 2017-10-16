<?php

namespace Vanbrabantf\NpmStatFetcher;

use Cake\Chronos\Chronos;
use DateTimeInterface;
use Vanbrabantf\NpmStatFetcher\Dates\DateChecker;
use Vanbrabantf\NpmStatFetcher\Package\Package;
use Vanbrabantf\NpmStatFetcher\Statistics\DownloadStatistics;

class StatFetcher
{
    /**
     * @var NpmRegistryRepository
     */
    private $repository;

    /**
     * @param NpmRegistryRepository $repository
     */
    public function __construct(NpmRegistryRepository $repository = null)
    {
        $this->repository = $repository ?: new NpmRegistryRepository(ClientFactory::Build());
    }


    /**
     * @param string $packageName
     *
     * @return DownloadStatistics
     */
    public function getDownloadsLastDay(string $packageName): DownloadStatistics
    {
        $package = new Package($packageName);

        $resource = $this->repository->getResourceByPath(
            '/downloads/point/last-day/' . $package
        );

        return DownloadStatistics::fromJson($package, $resource);
    }

    /**
     * @param string $packageName
     *
     * @return DownloadStatistics
     */
    public function getDownloadsLastWeek(string $packageName): DownloadStatistics
    {
        $package = new Package($packageName);

        $resource = $this->repository->getResourceByPath(
            '/downloads/point/last-week/' . $package
        );

        return DownloadStatistics::fromJson($package, $resource);
    }

    /**
     * @param string $packageName
     *
     * @return DownloadStatistics
     */
    public function getDownloadsLastMonth(string $packageName): DownloadStatistics
    {
        $package = new Package($packageName);

        $resource = $this->repository->getResourceByPath(
            '/downloads/point/last-month/' . $package
        );

        return DownloadStatistics::fromJson($package, $resource);
    }

    /**
     * @param string $packageName
     *
     * @return DownloadStatistics
     */
    public function getDownloadsLastYear(string $packageName): DownloadStatistics
    {
        $package = new Package($packageName);

        $resource = $this->repository->getResourceByPath(
            '/downloads/point/last-year/' . $package
        );

        return DownloadStatistics::fromJson($package, $resource);
    }

    /**
     * @param string $packageName
     *
     * @return DownloadStatistics
     */
    public function getDownloads(string $packageName): DownloadStatistics
    {
        $package = new Package($packageName);
        $start = new Chronos('1999-01-01');
        $now = new Chronos();

        DateChecker::validateDateRange($start, $now);

        $resource = $this->repository->getResourceByPath(
            '/downloads/point/' . $start->format('Y-m-d') . ':' . $now->format('Y-m-d') . '/' . $package
        );

        return DownloadStatistics::fromJson($package, $resource);
    }


    /**
     * @param string $packageName
     * @param DateTimeInterface $start
     * @param DateTimeInterface $end
     *
     * @return DownloadStatistics
     */
    public function getDownloadsBetweenDates(
        string $packageName,
        DateTimeInterface $start,
        DateTimeInterface $end
    ): DownloadStatistics
    {
        DateChecker::validateDateRange($start, $end);

        $package = new Package($packageName);

        $resource = $this->repository->getResourceByPath(
            '/downloads/point/' . $start->format('Y-m-d') . ':' . $end->format('Y-m-d') . '/' . $package
        );

        return DownloadStatistics::fromJson($package, $resource);
    }
}
