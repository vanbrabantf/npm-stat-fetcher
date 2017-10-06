<?php

namespace Vanbrabantf\NpmStatFetcher\ValueObjects;

use DateTimeImmutable;

class DownloadStatistics extends Statistics
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
    public function __toString()
    {
        return (string)$this->downloads;
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
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getEndDate()
    {
        return $this->endDate;
    }
}