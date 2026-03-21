<?php
declare(strict_types=1);


namespace Framework\Http;

use FastRoute\RouteCollector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use function FastRoute\simpleDispatcher;

class Kernel
{
    public function handler(Request $request): Response
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

        $response = call_user_func_array([new $controller, $method], $vars);

        return $response;
    }

}