<?php
declare(strict_types=1);


namespace Framework\Container;

use Framework\Container\Execptions\ContainerException;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    private array $services = [];

    public function add(string $id, string|object|null $concrete_container=null)
    {
        if(is_null($concrete_container)) {
            if (!class_exists($id)) {
                throw new ContainerException("service: $id not found");
            }

            $concrete_container = $id;
        }

        $this->services[$id] = $concrete_container;

    }

    public function get(string $id)
    {
        if (! $this->has($id)) {
            if (!class_exists($id)) {
                throw new ContainerException("service: $id not be resolved");
            }

            $this->add($id);
        }

        $instance = $this->resolve($this->services[$id]);

        return $instance;
    }

    private function resolve($class)
    {
        $reflection = new \ReflectionClass($class);

        $constructor = $reflection->getConstructor();

        if (is_null($constructor)) {
            return $reflection->newInstance();
        }

        $constructorParams = $constructor->getParameters();

        $classDependencies = $this->resolveClassDependencies($constructorParams);

        $instance = $reflection->newInstanceArgs($classDependencies);

        return $instance;
    }

    private function resolveClassDependencies(array $constructorParams): array
    {
        $classDependencies = [];

        /** @var  $constructorParam */
        foreach ($constructorParams as $constructorParam) {

            $serviceType = $constructorParam->getType();

            $service = $this->get($serviceType->getName());

            $classDependencies[] = $service;
        }

        return $classDependencies;
    }

    public function has(string $id): bool
    {
        return isset($this->services[$id]);
    }
}