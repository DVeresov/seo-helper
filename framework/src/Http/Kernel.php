<?php
declare(strict_types=1);


namespace Framework\Http;

use Framework\Exception\HttpException;
use Framework\Routing\RouteDispatcherInterface;
use League\Container\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Kernel
{
    private string $appEnv;

    public function __construct(
        readonly RouteDispatcherInterface $router,
        private Container                 $container)
    {
        $this->appEnv = $this->container->get('APP_ENV');
    }

    public function handler(Request $request): Response
    {
        try {

            [$routeHandler, $vars] = $this->router->dispatch($request, $this->container);

            $response = call_user_func_array($routeHandler, $vars);
        } catch (HttpException $e) {
            $response = new Response($e->getMessage(), Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            $response = $this->createExceptionResponse($e);
        }

        return $response;
    }

    private function createExceptionResponse(\Exception $exception): Response
    {
        if (in_array($this->appEnv, ['dev', 'test'])) {
            throw $exception;
        }

        if ($exception instanceof HttpException) {
            return new Response($exception->getMessage(), $exception->getStatusCode());
        }

        return new Response("Server error", Response::HTTP_INTERNAL_SERVER_ERROR);
    }

}