<?php

namespace Aplicacion\Middlewares;

use Aplicacion\models\Usuario;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use \Firebase\JWT\JWT;

class ValidationMiddleWare
{

    public function __invoke(Request $request, RequestHandler $handler)
    {
        $response = new Response();
        $req = $request->getParsedBody();

        $nombre = $req["nombre"];
        $clave = $req["clave"];
        $tipo = $req["tipo"];
        $email = $req["email"];

        $userEmail = Usuario::where('email', $email)->first();
        $userNombre = Usuario::where('nombre', $nombre)->first();
        if ($userEmail == null && strlen($clave)) {
            if ($userNombre == null) {
                if ($tipo == "admin" || $tipo == "alumno" || $tipo == "profesor") {

                    $resp = $handler->handle($request);
                    $existingContent = (string) $resp->getBody();
                    $response->getBody()->write($existingContent);

                    
                } else {
                    $response->getBody()->write(json_encode("Datos incorrectos"));
                }
            } else {
                $response->getBody()->write(json_encode("Datos incorrectos"));
            }
        } else {
            $response->getBody()->write(json_encode("Datos incorrectos"));
        }
        return $response;
    }
}
