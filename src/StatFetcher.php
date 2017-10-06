<?php

namespace Vanbrabantf\NpmStatFetcher;


use Cake\Chronos\Chronos;
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
    public function __construct(Package $package, NpmRegistryRepository $repository)
    {
        $this->package = $package;
        $this->repository = $repository;
    }

    /**
     * @return DownloadStatistics
     */
    public function getDownloadsLastDay()
    {
        $resource = $this->repository->getResourceByPath(
            '/downloads/point/last-day/' . $this->package
        );

        $resourceArray = json_decode($resource);

        return new DownloadStatistics(
            $this->package,
            $resourceArray->downloads,
            new Chronos($resourceArray->start),
            new Chronos($resourceArray->end)
        );
    }
}