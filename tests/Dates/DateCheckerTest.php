<?php

namespace Vanbrabantf\NpmStatFetcher\Tests\Dates;

use Cake\Chronos\Chronos;
use PHPUnit\Framework\TestCase;
use Vanbrabantf\NpmStatFetcher\Dates\DateChecker;
use Vanbrabantf\NpmStatFetcher\Dates\DateException;

class DateCheckerTest extends TestCase
{
    /**
     * @test
     */
    public function itErrorsOnStartDateInTheFuture()
    {
        $this->expectException(DateException::class);

        $start = new Chronos('+1 year');
        $end = new Chronos('+2 year');

        DateChecker::validateDateRange($start, $end);
    }

    /**
     * @test
     */
    public function itErrorsOnEndDateInTheFuture()
    {
        $this->expectException(DateException::class);

        $start = new Chronos('-1 day');
        $end = new Chronos('+2 year');

        DateChecker::validateDateRange($start, $end);
    }

    /**
     * @test
     */
    public function itErrorsOnSmallerEndDateThanStartdateInTheFuture()
    {
        $this->expectException(DateException::class);

        $start = new Chronos('+1 day');
        $end = new Chronos('-1 month');

        DateChecker::validateDateRange($start, $end);
    }

    /**
     * @test
     */
    public function itDoesntErrorOnValidData()
    {
        $start = new Chronos('-1 month');
        $end = new Chronos('-14 days');

        $this->assertTrue(DateChecker::validateDateRange($start, $end));
    }
}
