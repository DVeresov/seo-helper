<?php
declare(strict_types=1);

use Framework\Http\Kernel;
use Framework\Routing\RouteDispatcher;
use Symfony\Component\HttpFoundation\Request;

define('APP_PATH', dirname(__DIR__));

require_once APP_PATH . '/vendor/autoload.php';


$request = Request::createFromGlobals();

/** @var \League\Container\Container $container */
$container = require APP_PATH . '/config/services.php';

$kernel = $container->get(Kernel::class);

$response = $kernel->handler($request);

$response->send();

