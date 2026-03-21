<?php

namespace Framework\Routing;

use Symfony\Component\HttpFoundation\Request;

interface RouteDispatcherInterface
{
    public function dispatch(Request $request);
}