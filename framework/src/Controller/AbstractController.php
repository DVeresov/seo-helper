<?php
declare(strict_types=1);


namespace Framework\Controller;

use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

abstract class AbstractController
{

    public function __construct(protected ContainerInterface $container)
    {
    }

    public function setContainer(ContainerInterface $container): void
    {
        $this->container = $container;
    }

    public function render(string $view, array $parameters = [], Response $response = null): Response
    {
        /** @var Environment $twig */
        $twig = $this->container->get('twig');

        $content = $twig->render($view, $parameters);

        $response ??= new Response();

        $response->setContent($content);

        return $response;
    }
}