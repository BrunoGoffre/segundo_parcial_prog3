<?php

namespace Aplicacion\Middlewares;

use Aplicacion\models\Usuario;
use Aplicacion\Token;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use \Firebase\JWT\JWT;

class TokenValidationMiddleWare
{

    public function __invoke(Request $request, RequestHandler $handler)
    {
        $response = new Response();
        $headers  = $request->getHeaders();
        $req = $request->getParsedBody();
        $token = $headers["token"];

        $decode = Token::class . ":AutenticarToken($token)";
        if($decode != " "){
            $resp = $handler->handle($request);
            $existingContent = (string) $resp->getBody();
            $response->getBody()->write($existingContent);
        }else{
            $response->getBody()->write("Error de autenticacion");
        }

      
        return $response;
    }
}


