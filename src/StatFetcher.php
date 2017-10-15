<?php

namespace Vanbrabantf\NpmStatFetcher;

use Cake\Chronos\Chronos;
use DateTimeInterface;
use Vanbrabantf\NpmStatFetcher\Builders\ClientBuilder;
use Vanbrabantf\NpmStatFetcher\Helpers\DateChecker;
use Vanbrabantf\NpmStatFetcher\Repositories\NpmRegistryRepository;
use Vanbrabantf\NpmStatFetcher\ValueObjects\DownloadStatistics;
use Vanbrabantf\NpmStatFetcher\ValueObjects\Package;

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

        $this->repository = $repository ?: new NpmRegistryRepository(ClientBuilder::Build());
    }

    /**
     * @return DownloadStatistics
     */
    public function getDownloadsLastDay()
    {
        $resource = $this->repository->getResourceByPath(
            '/downloads/point/last-day/' . $this->package
        );

        return DownloadStatistics::fromJson($this->package, $resource);
    }

    /**
     * @return DownloadStatistics
     */
    public function getDownloadsLastWeek()
    {
        $resource = $this->repository->getResourceByPath(
            '/downloads/point/last-week/' . $this->package
        );

        return DownloadStatistics::fromJson($this->package, $resource);
    }

    /**
     * @return DownloadStatistics
     */
    public function getDownloadsLastMonth()
    {
        $resource = $this->repository->getResourceByPath(
            '/downloads/point/last-month/' . $this->package
        );

        return DownloadStatistics::fromJson($this->package, $resource);
    }

    /**
     * @return DownloadStatistics
     */
    public function getDownloadsLastYear()
    {
        $resource = $this->repository->getResourceByPath(
            '/downloads/point/last-year/' . $this->package
        );

        return DownloadStatistics::fromJson($this->package, $resource);
    }

    /**
     * @return DownloadStatistics
     */
    public function getDownloads()
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
    public function getDownloadsBetweenDates(DateTimeInterface $start, DateTimeInterface $end)
    {
        DateChecker::validateDateRange($start, $end);

        $resource = $this->repository->getResourceByPath(
            '/downloads/point/' . $start->format('Y-m-d') . ':' . $end->format('Y-m-d') . '/' . $this->package
        );

        return DownloadStatistics::fromJson($this->package, $resource);
    }
}
