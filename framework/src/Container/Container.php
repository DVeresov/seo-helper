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
                throw new ContainerException("service: $id does not exist");
            }

            $concrete_container = $id;
        }

        $this->services[$id] = $concrete_container;

    }

    public function get(string $id)
    {
        return new $this->services[$id];
    }

    public function has(string $id): bool
    {
        // TODO: Implement has() method.
    }
}