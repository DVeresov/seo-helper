<?php
declare(strict_types=1);


namespace Framework\Routing;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Framework\Exception\HttpException;
use Framework\Exception\MethodNotFoundException;
use League\Container\Container;
use Symfony\Component\HttpFoundation\Request;
use function FastRoute\simpleDispatcher;

class RouteDispatcher implements RouteDispatcherInterface
{
    private array $routes;

    /**
     * @throws HttpException
     */
    public function dispatch(Request $request, Container $container): array
    {
        [$handler, $vars] = $this->extractRouteInfo($request);

        if (is_array($handler)) {
            [$controllerId, $method] = $handler;
            $controller = $container->get($controllerId);

            return [[new $controller, $method], $vars];
        }

        return [$handler, $vars];

    }

    public function registerRoutes(array $routes): void
    {
        $this->routes = $routes;
    }

    private function extractRouteInfo(Request $request): array
    {
        $dispatcher = simpleDispatcher(function (RouteCollector $collector) {

            foreach ($this->routes as $route) {
                $collector->addRoute(...$route);
            }

        });

        $uri = $request->getPathInfo();
        $method = $request->getMethod();

        $routeInfo = $dispatcher->dispatch($method, $uri);

        $result = match ($routeInfo[0]) {
            Dispatcher::NOT_FOUND =>
            throw (new HttpException('404 Not Found'))->setStatusCode(404),
            Dispatcher::METHOD_NOT_ALLOWED =>
            throw (new MethodNotFoundException('405 Method Not Allowed'))->setStatusCode(405),
            Dispatcher::FOUND => null,
            default => throw (new HttpException('Unknown routing status'))->setStatusCode(500),
        };

        [$status, $handler, $vars] = $routeInfo;

        return [$handler, $vars];
    }

}