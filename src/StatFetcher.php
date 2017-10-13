<?php

namespace Vanbrabantf\NpmStatFetcher;

use GuzzleHttp\Client;
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
    )
    {
        $this->package = $package;

        if (is_null($repository)) {
            $this->repository = new NpmRegistryRepository(new Client());
        } else {
            $this->repository = $repository;
        }
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
}
