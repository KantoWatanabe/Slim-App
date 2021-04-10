<?php
namespace App\Actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;
use Twig\Environment as Twig;

class HomeAction
{
    private ContainerInterface $container;
    private Twig $view;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->view = $this->container->get('view');
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $response = $response->withHeader('Content-Type', 'text/html');
        $body = $this->view->render('index.html.twig');
        $response->getBody()->write($body);
        return $response;
    }
}