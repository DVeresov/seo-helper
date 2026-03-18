<?php
declare(strict_types=1);

use Framework\Http\Kernel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

define('APP_PATH', dirname(__DIR__));

require_once APP_PATH . '/vendor/autoload.php';

$request = Request::createFromGlobals();

$kernel = new Kernel();
$response = $kernel->handler($request);

$response->send();