<?php

namespace Vanbrabantf\NpmStatFetcher;

use PHPUnit\Framework\TestCase;
use Vanbrabantf\NpmStatFetcher\Exceptions\EmptyValueException;

class PackageTest extends TestCase
{
    /**
     * @test
     */
    public function iCanGetTheNameFromAPackage()
    {
        $package = new Package('care');

        $this->assertSame('care', (string) $package);
    }

    /**
     * @test
     */
    public function iCantEnterAnEmptyNamedPackage()
    {
        $this->expectException(EmptyValueException::class);

        new Package('');
    }
}