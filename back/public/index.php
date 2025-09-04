<?php

use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy;
use Slim\Factory\AppFactory;
use Slim\Exception\HttpNotFoundException;


ini_set("display_errors", 1);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ .'/controller/booking/Disponibilita.php';
require __DIR__ .'/controller/booking/Prenotazione.php';



$container = new Container();
AppFactory::setContainer($container);

$app = AppFactory::create();

$app->addRoutingMiddleware();
$app->addBodyParsingMiddleware();

$app->options('/{routes:.+}', function ($request, $response,Array $args) {
    $response = $response->withHeader('Access-Control-Allow-Origin', '*');
    return $response
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    $response = $response->withHeader('Access-Control-Allow-Origin', '*');
    return $response
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

$app->get('/', function ($request, $response,Array $args) {
    $response->getBody()->write('hotel');
    return $response;
});


$app->get('/disponibilita', \DisponibilitaController::class .':getDisp');

$app->post('/prenotazione', \PrenotazioneController::class .':setPren');


$app->addErrorMiddleware(true, true, true);

$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response, $args) {
    throw new HttpNotFoundException($request);
});

$app->run();

?>