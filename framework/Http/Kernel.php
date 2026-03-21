<?php
declare(strict_types=1);


namespace Framework\Http;

use FastRoute\RouteCollector;
use Framework\Exception\HttpException;
use Framework\Exception\MethodNotFoundException;
use Framework\Routing\RouteDispatcher;
use Framework\Routing\RouteDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use function FastRoute\simpleDispatcher;

class Kernel
{
    public function __construct(readonly RouteDispatcherInterface $router)
    {
    }

    public function handler(Request $request): Response
    {
        try {
            [$routeHandler, $vars] = $this->router->dispatch($request);

            $response = call_user_func_array($routeHandler, $vars);
        }
        catch (HttpException $e) {
            $response = new Response($e->getMessage(), Response::HTTP_METHOD_NOT_ALLOWED);
        }
        catch (\Throwable $e) {
            $response = new Response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $response;
    }

}