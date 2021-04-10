<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use DI\Bridge\Slim\Bridge;
use DI\ContainerBuilder;
use Twig\Environment as Twig;
use Twig\Loader\FilesystemLoader;

require __DIR__ . '/../vendor/autoload.php';

$builder = new ContainerBuilder();
$builder->addDefinitions([
    Twig::class => function () {
        $loader = new FilesystemLoader(__DIR__ . '/../templates');
        return new Twig($loader, [
            'cache' => __DIR__ . '/../tmp/cache/twig',
        ]);
    },
]);

$app = Bridge::create($builder->build());

/*
$app->get('/', function (Request $request, Response $response, $args) {
    $payload = json_encode(['hello' => 'world'], JSON_PRETTY_PRINT);
    $response->getBody()->write($payload);
    return $response->withHeader('Content-Type', 'application/json');
});
*/
/*
$app->add(function (Request $request, RequestHandler $handler) {
    $response = $handler->handle($request);
    $existingContent = (string) $response->getBody();

    $response = new Response();
    $response->getBody()->write('BEFORE ' . $existingContent);

    return $response;
});

$app->add(function (Request $request, RequestHandler $handler) {
    $response = $handler->handle($request);
    $response->getBody()->write(' AFTER');
    return $response;
});*/

$routes = require __DIR__ . '/../routes/web.php';
$routes($app);

$app->run();
