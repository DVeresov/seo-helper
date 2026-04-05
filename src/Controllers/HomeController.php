<?php declare(strict_types=1);


namespace App\Controllers;

use Framework\Controller\AbstractController;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HomeController extends AbstractController
{

    public function hello(): Response
    {
        $twig = $this->container->get('twig');

        return $this->render('home.html.twig');
    }

    public function project(int $id): Response
    {
        $content = "<h1>hello world from HomeController project: #$id</h1>";

        return new Response($content);
    }
}