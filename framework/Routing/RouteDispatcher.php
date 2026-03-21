<?php
declare(strict_types=1);


namespace Framework\Routing;

use FastRoute\RouteCollector;
use Symfony\Component\HttpFoundation\Request;
use function FastRoute\simpleDispatcher;

class RouteDispatcher implements RouteDispatcherInterface
{
    public function dispatch(Request $request): array
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
        [$status, [$controller, $method], $vars] = $routeInfo;

        return [[new $controller, $method], $vars];
    }

}