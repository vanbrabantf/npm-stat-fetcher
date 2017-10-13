<?php

namespace Vanbrabantf\NpmStatFetcher\Helpers;

use Cake\Chronos\Chronos;
use DateTimeInterface;
use Vanbrabantf\NpmStatFetcher\Exceptions\DateException;

class DateChecker
{
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
