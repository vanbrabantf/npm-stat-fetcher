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
     * @var Package
     */
    private $package;

    /**
     * @var NpmRegistryRepository
     */
    private $repository;

    /**
     * @param Package $package
     * @param NpmRegistryRepository $repository
     */
    public function __construct(
        Package $package,
        $repository = null
    ) {
        $this->package = $package;

        $this->repository = $repository ?: new NpmRegistryRepository(ClientFactory::Build());
    }

    /**
     * @return DownloadStatistics
     */
    public function getDownloadsLastDay(): DownloadStatistics
    {
        $resource = $this->repository->getResourceByPath(
            '/downloads/point/last-day/' . $this->package
        );

        return DownloadStatistics::fromJson($this->package, $resource);
    }

    /**
     * @return DownloadStatistics
     */
    public function getDownloadsLastWeek(): DownloadStatistics
    {
        $resource = $this->repository->getResourceByPath(
            '/downloads/point/last-week/' . $this->package
        );

        return DownloadStatistics::fromJson($this->package, $resource);
    }

    /**
     * @return DownloadStatistics
     */
    public function getDownloadsLastMonth(): DownloadStatistics
    {
        $resource = $this->repository->getResourceByPath(
            '/downloads/point/last-month/' . $this->package
        );

        return DownloadStatistics::fromJson($this->package, $resource);
    }

    /**
     * @return DownloadStatistics
     */
    public function getDownloadsLastYear(): DownloadStatistics
    {
        $resource = $this->repository->getResourceByPath(
            '/downloads/point/last-year/' . $this->package
        );

        return DownloadStatistics::fromJson($this->package, $resource);
    }

    /**
     * @return DownloadStatistics
     */
    public function getDownloads(): DownloadStatistics
    {
        $start = new Chronos('1999-01-01');
        $now = new Chronos();

        DateChecker::validateDateRange($start, $now);

        $resource = $this->repository->getResourceByPath(
            '/downloads/point/' . $start->format('Y-m-d') . ':' . $now->format('Y-m-d') . '/' . $this->package
        );

        return DownloadStatistics::fromJson($this->package, $resource);
    }

    /**
     * @param DateTimeInterface $start
     * @param DateTimeInterface $end
     *
     * @return DownloadStatistics
     */
    public function getDownloadsBetweenDates(DateTimeInterface $start, DateTimeInterface $end): DownloadStatistics
    {
        DateChecker::validateDateRange($start, $end);

        $resource = $this->repository->getResourceByPath(
            '/downloads/point/' . $start->format('Y-m-d') . ':' . $end->format('Y-m-d') . '/' . $this->package
        );

        return DownloadStatistics::fromJson($this->package, $resource);
    }
}
