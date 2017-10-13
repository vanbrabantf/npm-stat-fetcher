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
}
