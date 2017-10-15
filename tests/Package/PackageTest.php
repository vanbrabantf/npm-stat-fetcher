<?php

namespace Vanbrabantf\NpmStatFetcher\tests\Package;

use PHPUnit\Framework\TestCase;
use Vanbrabantf\NpmStatFetcher\Package\EmptyValueException;
use Vanbrabantf\NpmStatFetcher\Package\Package;

class PackageTest extends TestCase
{
    /**
     * @test
     */
    public function itCanGetTheNameFromAPackage()
    {
        $package = new Package('care');

        $this->assertSame('care', (string) $package);
    }

    /**
     * @test
     */
    public function itCantEnterAnEmptyNamedPackage()
    {
        $this->expectException(EmptyValueException::class);

        new Package('');
    }
}
