<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Twig\Environment as Twig;

class HomeController
{
    private Twig $twig;

    public function __construct(Twig $twig)
    {
        $this->twig = $twig;
    }

    public function index(Response $response): Response
    {
        $response = $response->withHeader('Content-Type', 'text/html');
        $body = $this->twig->render('index.html.twig');
        $response->getBody()->write($body);
        return $response;
    }
}