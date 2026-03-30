<?php
declare(strict_types=1);


namespace Framework\Tests;

class SomeClass
{
    public function __construct(private readonly Fake $fake)
    {
    }

    public function getFake(): Fake
    {
        return $this->fake;
    }

}