<?php

namespace Vanbrabantf\NpmStatFetcher\Dates;

use Cake\Chronos\Chronos;
use DateTimeInterface;

class DateChecker
{
    /**
     * @param DateTimeInterface $start
     * @param DateTimeInterface $end
     * @return bool
     * @throws DateException
     */
    public static function validateDateRange(DateTimeInterface $start, DateTimeInterface $end)
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

        return true;
    }
}
