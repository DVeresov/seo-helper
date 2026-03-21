<?php
declare(strict_types=1);


namespace Framework\Routing;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Framework\Exception\HttpException;
use Framework\Exception\MethodNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use function FastRoute\simpleDispatcher;

class RouteDispatcher implements RouteDispatcherInterface
{
    /**
     * @throws HttpException
     */
    public function dispatch(Request $request): array
    {
        [$handler, $vars] = $this->extractRouteInfo($request);

        if (is_array($handler)) {
            [$controller, $method] = $handler;
            return [[new $controller, $method], $vars];
        }

        return [$handler, $vars];

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
            throw new HttpException('404 Not Found', 404),
            Dispatcher::METHOD_NOT_ALLOWED =>
            throw new MethodNotFoundException('405 Method Not Allowed', 405),
            Dispatcher::FOUND => null,
            default => throw new HttpException('Unknown routing status', 500),
        };

        [$status, $handler, $vars] = $routeInfo;

        return [$handler, $vars];
    }

}