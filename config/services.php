<?php
declare(strict_types=1);

use Framework\Http\Kernel;
use League\Container\Argument\Literal\ArrayArgument;
use League\Container\Container;
use \Framework\Routing\RouteDispatcherInterface;
use \Framework\Routing\RouteDispatcher;

// Application parameters

$routes = include_once APP_PATH . '/routes/web.php';

// Application services

$container = new Container();

$container->add(RouteDispatcherInterface::class, RouteDispatcher::class);

$container->extend(RouteDispatcherInterface::class)->addMethodCall('registerRoutes', [new ArrayArgument($routes)]);

$container->add(Kernel::class)->addArgument(RouteDispatcherInterface::class);

return $container;