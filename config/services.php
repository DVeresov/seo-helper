<?php
declare(strict_types=1);

use Framework\Http\Kernel;
use League\Container\Argument\Literal\ArrayArgument;
use League\Container\Argument\Literal\StringArgument;
use League\Container\Container;
use \Framework\Routing\RouteDispatcherInterface;
use \Framework\Routing\RouteDispatcher;
use League\Container\ReflectionContainer;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->loadEnv(APP_PATH . '/.env');

// Application parameters

$routes = include_once APP_PATH . '/routes/web.php';

// Application services

$container = new Container();

$container->delegate(new ReflectionContainer(true));

$appEnv = $_ENV['APP_ENV'] ?? 'dev';

$container->add('APP_ENV', new StringArgument($appEnv));

$container->add(RouteDispatcherInterface::class, RouteDispatcher::class);

$container->extend(RouteDispatcherInterface::class)->addMethodCall('registerRoutes', [$routes]);

$container->add(Kernel::class)->addArgument(RouteDispatcherInterface::class)
->addArgument($container);

return $container;