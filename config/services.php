<?php
declare(strict_types=1);

use Framework\Controller\AbstractController;
use Framework\Http\Kernel;
use League\Container\Argument\Literal\ArrayArgument;
use League\Container\Argument\Literal\StringArgument;
use League\Container\Container;
use \Framework\Routing\RouteDispatcherInterface;
use \Framework\Routing\RouteDispatcher;
use League\Container\ReflectionContainer;
use Psr\Container\ContainerInterface;
use Symfony\Component\Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\Loader\LoaderInterface;

$dotenv = new Dotenv();
$dotenv->loadEnv(APP_PATH . '/.env');

// Application parameters

$routes = include_once APP_PATH . '/routes/web.php';
$appEnv = $_ENV['APP_ENV'] ?? 'dev';
$viewPath = APP_PATH . '/views';

// Application services

$container = new Container();

$container->delegate(new ReflectionContainer(true));

$container->add('APP_ENV', new StringArgument($appEnv));

$container->add(RouteDispatcherInterface::class, RouteDispatcher::class);

$container->extend(RouteDispatcherInterface::class)->addMethodCall('registerRoutes', [$routes]);

$container->add(Kernel::class)->addArgument(RouteDispatcherInterface::class)
    ->addArgument($container);

// twig
// Настройка Twig через фабрику (замыкание)
$container->addShared(\Twig\Environment::class, function () use ($viewPath) {
    // 1. Создаем лоадер вручную, жестко передавая путь
    $loader = new \Twig\Loader\FilesystemLoader($viewPath);

    // 2. Создаем и возвращаем сам Twig
    return new \Twig\Environment($loader, [
        'cache' => false, // Пока отключаем кэш для разработки
    ]);
});

// Добавляем строковый алиас 'twig', на случай если ты вызываешь $container->get('twig')
$container->add('twig', $container->get(\Twig\Environment::class));

return $container;