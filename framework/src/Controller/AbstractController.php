<?php
declare(strict_types=1);


namespace Framework\Controller;

use Psr\Container\ContainerInterface;

abstract class AbstractController
{

    public function __construct(protected ContainerInterface $container)
    {
    }

    public function setContainer(ContainerInterface $container): void
    {
        $this->container = $container;
    }
}