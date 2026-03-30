<?php
declare(strict_types=1);


namespace Framework\Tests;

class FrameworkClass
{
    public function __construct(private readonly SomeClass $someClass)
    {

    }

    public function getSomeClass(): SomeClass
    {
        return $this->someClass;
    }

}