<?php

namespace Vanbrabantf\NpmStatFetcher\Package;

class Package
{
    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     * @throws EmptyValueException
     */
    public function __construct(string $name)
    {
        if(empty($name)) {
            throw new EmptyValueException('Package name can\'t be empty');
        }

        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
