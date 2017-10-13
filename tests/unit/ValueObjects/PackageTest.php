<?php

namespace Vanbrabantf\NpmStatFetcher\tests\unit\ValueObjects;

use PHPUnit\Framework\TestCase;
use Vanbrabantf\NpmStatFetcher\Exceptions\EmptyValueException;
use Vanbrabantf\NpmStatFetcher\ValueObjects\Package;

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
