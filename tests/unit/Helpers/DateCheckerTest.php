<?php

namespace Vanbrabantf\NpmStatFetcher\Tests\unit\Helpers;

use Cake\Chronos\Chronos;
use PHPUnit\Framework\TestCase;
use Vanbrabantf\NpmStatFetcher\Exceptions\DateException;
use Vanbrabantf\NpmStatFetcher\Helpers\DateChecker;

class DateCheckerTest extends TestCase
{
    /**
     * @test
     */
    public function ItErrorsOnStartDateInTheFuture()
    {
        $this->expectException(DateException::class);

        $start = new Chronos('+1 year');
        $end = new Chronos('+2 year');

        DateChecker::validateDateRange($start, $end);
    }

    /**
     * @test
     */
    public function ItErrorsOnEndDateInTheFuture()
    {
        $this->expectException(DateException::class);

        $start = new Chronos('-1 day');
        $end = new Chronos('+2 year');

        DateChecker::validateDateRange($start, $end);
    }

    /**
     * @test
     */
    public function ItErrorsOnSmallerEndDateThanStartdateInTheFuture()
    {
        $this->expectException(DateException::class);

        $start = new Chronos('+1 day');
        $end = new Chronos('-1 month');

        DateChecker::validateDateRange($start, $end);
    }

    /**
     * @test
     */
    public function ItDoesntErrorOnValidData()
    {
        $start = new Chronos('-1 month');
        $end = new Chronos('-14 days');

        $this->assertTrue(DateChecker::validateDateRange($start, $end));
    }
}
