<?php
namespace App\Actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Psr\Container\ContainerInterface;
use Monolog\Logger;

abstract class Action
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var array
     */
    protected $args;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->logger = $this->get('logger');
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;

        return $this->action();
    }

    /**
     * @return Response
     */
    abstract protected function action(): Response;

    /**
     * @param string $name
     * @return mixed
     */
    protected function get(string $name)
    {
        return $this->container->get($name);
    }

    /**
     * @param string $name
     * @return mixed $default
     * @return mixed
     */
    protected function header(string $name, $default = null)
    {
        return $this->request->getHeaderLine($name) ?? $default;
    }

    /**
     * @param string $name
     * @return mixed $default
     * @return mixed
     */
    protected function query(string $name, $default = null)
    {
        $params = $this->request->getQueryParams();
        return $params[$name] ?? $default;
    }

    /**
     * @param string $name
     * @return mixed $default
     * @return mixed
     */
    protected function body(string $name, $default = null)
    {
        $params = $this->request->getParsedBody();
        return $params[$name] ?? $default;
    }

    /**
     * @param string $name
     * @return mixed $default
     * @return mixed
     */
    protected function arg(string $name, $default = null)
    {
        return $this->args[$name] ?? $default;
    }

    /**
     * @return array
     * @throws HttpBadRequestException
     */
    protected function formData()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new HttpBadRequestException($this->request, 'Malformed JSON input.');
        }

        return $input;
    }

    /**
     * @param string $uri
     * @param int $statusCode
     * @return Response
     */
    protected function redirect(string $uri, int $statusCode = 301): Response
    {
        return $this->response
                    ->withHeader('Location', $uri)
                    ->withStatus($statusCode);
    }

    /**
     * @param string $name
     * @param array $data
     * @param int $statusCode
     * @return Response
     */
    protected function render(string $name, array $data = [], int $statusCode = 200): Response
    {
        $body = $this->get('view')->render('index.html.twig', $data);
        $this->response->getBody()->write($body);

        return $this->response
                    ->withHeader('Content-Type', 'text/html')
                    ->withStatus($statusCode);
    }

    /**
     * @param array $data
     * @param int $statusCode
     * @return Response
     */
    protected function json(array $data, int $statusCode = 200): Response
    {
        $json = json_encode($data, JSON_PRETTY_PRINT);
        $this->response->getBody()->write($json);

        return $this->response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus($statusCode);
    }
}
