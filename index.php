<?php

require __DIR__ . './vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Exception\HttpNotFoundException;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Middleware\ErrorMiddleware;

use Aplicacion\Controller\UserController;
use Aplicacion\models\regitros;
use Aplicacion\Middlewares\JSONMiddleWare;
use Config\Database;


$app = AppFactory::create();
$app->setBasePath("/segundo_parcial_prog3");
//$app->addRoutingMiddleware();
new Database;


$app->post('/registro/{id}', UserController::class . ":addUser");
$app->delete('/registro/{id}', UserController::class . ":delete");
$app->post('/', UserController::class . ":addUsuario");
$app->get('/',  UserController::class . ":getAll" )->add(new JSONMiddleWare);

$app->group('/users', function (RouteCollectorProxy $group) {

    $group->get('/{id}', UserController::class . ":getOne");

    $group->get('[/]', UserController::class . ":getAll");

    $group->post('[/]', UserController::class . ":add");

    $group->put('/{id}', UserController::class . ":update");

    $group->delete('/{id}', UserController::class . ":delete");
})->add(new JSONMiddleWare);

$app->run();