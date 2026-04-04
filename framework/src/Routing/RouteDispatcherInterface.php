<?php

namespace Framework\Routing;

use League\Container\Container;
use Symfony\Component\HttpFoundation\Request;

interface RouteDispatcherInterface
{
    public function dispatch(Request $request, Container $container): array;

    public function registerRoutes(array $routes): void;
}