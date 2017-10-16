<?php

namespace Vanbrabantf\NpmStatFetcher\Tests\Dates;

use Cake\Chronos\Chronos;
use PHPUnit\Framework\TestCase;
use Vanbrabantf\NpmStatFetcher\Dates\DateException;
use Vanbrabantf\NpmStatFetcher\Dates\DateRange;

class DateRangeTest extends TestCase
{
    /**
     * @test
     */
    public function itErrorsOnStartDateInTheFuture()
    {
        $this->expectException(DateException::class);

        $start = new Chronos('+1 year');
        $end = new Chronos('+2 year');

        new DateRange($start, $end);
    }

    /**
     * @test
     */
    public function itErrorsOnEndDateInTheFuture()
    {
        $this->expectException(DateException::class);

        $start = new Chronos('-1 day');
        $end = new Chronos('+2 year');

        new DateRange($start, $end);
    }

    /**
     * @test
     */
    public function itErrorsOnSmallerEndDateThanStartdateInTheFuture()
    {
        $this->expectException(DateException::class);

        $start = new Chronos('+1 day');
        $end = new Chronos('-1 month');

        new DateRange($start, $end);
    }

    /**
     * @test
     */
    public function itDoesntErrorOnValidData()
    {
        $start = new Chronos('-1 month');
        $end = new Chronos('-14 days');

        $range = new DateRange($start, $end);

        $this->assertSame($start, $range->getStartDate());
        $this->assertSame($end, $range->getEndDate());
    }
}
