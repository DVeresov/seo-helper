<?php
declare(strict_types=1);


namespace App\Controllers;

use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    public function hello(): Response
    {
        $content = "<h1>hello world from HomeController</h1>";

        return new Response($content);
    }

    public function project(int $id): Response
    {
        $content = "<h1>hello world from HomeController project: #$id</h1>";

        return new Response($content);
    }
}