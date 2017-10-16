<?php

namespace Vanbrabantf\NpmStatFetcher\Dates;

use Cake\Chronos\Chronos;
use DateTimeInterface;

final class DateRange
{
    /**
     * @var DateTimeInterface
     */
    private $startDate;

    /**
     * @var DateTimeInterface
     */
    private $endDate;

    /**
     * @param DateTimeInterface $startDate
     * @param DateTimeInterface $endDate
     */
    public function __construct(
        DateTimeInterface $startDate,
        DateTimeInterface $endDate
    ) {
        $this->validateDateRange($startDate, $endDate);

        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * @return DateTimeInterface
     */
    public function getStartDate(): DateTimeInterface
    {
        return $this->startDate;
    }

    /**
     * @return DateTimeInterface
     */
    public function getEndDate(): DateTimeInterface
    {
        return $this->endDate;
    }

    /**
     * @param DateTimeInterface $start
     * @param DateTimeInterface $end
     * @throws DateException
     */
    private function validateDateRange(DateTimeInterface $start, DateTimeInterface $end)
    {
        $start = new Chronos($start);
        $end = new Chronos($end);

        if ($start->isFuture()) {
            throw new DateException("Start date \"{$start}\" must be in the past");
        }

        if ($end->isFuture()) {
            throw new DateException("End date \"{$end}\" must be in the past");
        }

        if ($start > $end) {
            throw new DateException("Start date \"{$start}\" must be smaller than end date \"{$end}\"");
        }
    }
}
