<?php
declare(strict_types=1);

use App\Controllers\HomeController;
use Framework\Routing\Router;

return [
    Router::get('/', [HomeController::class, 'hello']),
    Router::get('/project/{id:\d+}', [HomeController::class, 'project']),
    Router::get('/hi/{name}', function (string $name) {
        return new \Symfony\Component\HttpFoundation\Response('Hello ' . $name . '!');
    }),
];