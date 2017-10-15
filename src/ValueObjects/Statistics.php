<?php

namespace Vanbrabantf\NpmStatFetcher\ValueObjects;

class Statistics
{
    /**
     * @var Package
     */
    private $package;

    /**
     * @param Package $package
     */
    public function __construct(Package $package)
    {
        $this->package = $package;
    }

    /**
     * @return string
     */
    public function getPackageName(): string
    {
        return (string) $this->package;
    }

    /**
     * @return Package
     */
    public function getPackage(): Package
    {
        return $this->package;
    }
}
