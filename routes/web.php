<?php
declare(strict_types=1);

use App\Controllers\HomeController;
use Framework\Routing\Router;

return [
    Router::get('/', [HomeController::class, 'hello']),
];