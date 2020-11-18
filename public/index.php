<?php

require __DIR__ . '../../vendor/autoload.php';

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
use Aplicacion\Middlewares\TokenValidationMiddleWare;
use Aplicacion\Middlewares\ValidationMiddleWare;
use Config\Database;


$app = AppFactory::create();
$app->setBasePath("/segundo_parcial_prog3/public");
new Database;



$app->post('/users[/]', UserController::class . ":newUser")->add(new ValidationMiddleWare)->add(new JSONMiddleWare);
$app->post('/login[/]', UserController::class . ":login")->add(new JSONMiddleWare);

$app->group('/materia', function (RouteCollectorProxy $group) {

    $group->post('[/]', UserController::class . ":AddMateria")->add(new TokenValidationMiddleWare);
    $group->get('/', UserController::class . ":getMaterias")->add(new TokenValidationMiddleWare);

})->add(new JSONMiddleWare);

$app->run();