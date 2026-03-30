<?php
declare(strict_types=1);


namespace Framework\Tests;

use Framework\Container\Execptions\ContainerException;
use PHPUnit\Framework\TestCase;
use Framework\Container\Container;

class ContainerTest extends TestCase
{
    public function test_getting_service_from_container(): void
    {
        $container = new Container();

        $container->add('framework-class', FrameworkClass::class);

        $this->assertInstanceOf(FrameworkClass::class, $container->get('framework-class'));
    }

    public function test_container_has_exception_in_ContainerException(): void
    {
        $container = new Container();

        $this->expectException(ContainerException::class);

        $container->add('no-class');

    }

    public function test_has_method()
    {
        $container = new Container();

        $container->add('framework-class', FrameworkClass::class);

        $this->assertTrue($container->has('framework-class'));
        $this->assertFalse($container->has('empty'));

    }

    public function test_recursively_autowrited()
    {
        $container = new Container();

        $container->add('framework-class', FrameworkClass::class);

        $frameworkClass = $container->get('framework-class');

        $someClass = $frameworkClass->getSomeClass();

        $this->assertInstanceOf(SomeClass::class, $frameworkClass->getSomeClass());
        $this->assertInstanceOf(Fake::class, $someClass->getFake());

    }

}