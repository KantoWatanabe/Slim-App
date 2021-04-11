<?php
namespace App\Actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;
use Twig\Environment as Twig;
use Monolog\Logger;

class HomeAction
{
    private ContainerInterface $container;
    private Twig $view;
    private Logger $logger;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->view = $this->container->get('view');
        $this->logger = $this->container->get('logger');
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $response = $response->withHeader('Content-Type', 'text/html');
        $body = $this->view->render('index.html.twig');
        $response->getBody()->write($body);
        return $response;
    }
}