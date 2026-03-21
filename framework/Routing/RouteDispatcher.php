<?php
declare(strict_types=1);


namespace Framework\Routing;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Symfony\Component\HttpFoundation\Request;
use function FastRoute\simpleDispatcher;

class RouteDispatcher implements RouteDispatcherInterface
{
    public function dispatch(Request $request): array
    {
        $routeInfo = $this->extractRouteInfo($request);
        [[$controller, $method], $vars] = $routeInfo;

        return [[new $controller, $method], $vars];
    }

    private function extractRouteInfo(Request $request): array
    {
        $dispatcher = simpleDispatcher(function (RouteCollector $collector) {

            $routes = include_once APP_PATH . '/routes/web.php';

            foreach ($routes as $route) {
                $collector->addRoute(...$route);
            }

        });

        $uri = $request->getPathInfo();
        $method = $request->getMethod();

        $routeInfo = $dispatcher->dispatch($method, $uri);

        $result = match ($routeInfo[0]) {
            Dispatcher::NOT_FOUND =>
            throw new \HttpException('404 Not Found', 404),
            Dispatcher::METHOD_NOT_ALLOWED =>
            throw new \HttpException('405 Method Not Allowed', 405),
            Dispatcher::FOUND => null,
            default => throw new \RuntimeException('Unknown routing status', 500),
        };

        [$status, [$controller, $method], $vars] = $routeInfo;

        return [[$controller, $method], $vars];
    }

}