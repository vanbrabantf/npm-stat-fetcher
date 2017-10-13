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

        if (
            $start->isFuture() ||
            $end->isFuture() ||
            $start > $end
        ) {
            throw new DateException('Date range is incorrect');
        }

        return true;
    }
}
