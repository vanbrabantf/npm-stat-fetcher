<?php

namespace Vanbrabantf\NpmStatFetcher\Statistics;

use Cake\Chronos\Chronos;
use DateTimeImmutable;
use Vanbrabantf\NpmStatFetcher\Package\Package;

class DownloadStatistics extends Statistics implements StatisticInterface
{
    /**
     * @var int
     */
    private $downloads;

    /**
     * @var DateTimeImmutable
     */
    private $startDate;

    /**
     * @var DateTimeImmutable
     */
    private $endDate;

    /**
     * @param Package $package
     * @param int $downloads
     * @param DateTimeImmutable $startDate
     * @param DateTimeImmutable $endDate
     */
    public function __construct(
        Package $package,
        int $downloads,
        DateTimeImmutable $startDate,
        DateTimeImmutable $endDate
    ) {
        parent::__construct($package);

        $this->downloads = $downloads;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->downloads;
    }

    /**
     * @param Package $package
     * @param string $resource
     *
     * @return StatisticInterface
     */
    public static function fromJson(Package $package, string $resource): StatisticInterface
    {
        $resourceArray = json_decode($resource);

        return new self(
            $package,
            $resourceArray->downloads,
            new Chronos($resourceArray->start),
            new Chronos($resourceArray->end)
        );
    }

    /**
     * @return int
     */
    public function getDownloads(): int
    {
        return $this->downloads;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getStartDate(): DateTimeImmutable
    {
        return $this->startDate;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getEndDate(): DateTimeImmutable
    {
        return $this->endDate;
    }
}
