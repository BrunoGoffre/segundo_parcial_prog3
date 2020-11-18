<?php
namespace Aplicacion\Controller;

use Aplicacion\models\Usuario;
use Aplicacion\models\Materia;
use Illuminate\Contracts\Routing\Registrar;
use \Firebase\JWT\JWT;

class UserController{
    
    public function newUser($request, $response, $args) {
        $req = $request->getParsedBody();
        
        $nombre = $req["nombre"];
        $clave = $req["clave"];
        $tipo = $req["tipo"];
        $email = $req["email"];

        $user = new Usuario;
        $user->nombre = $nombre;
        $user->clave = $clave;
        $user->tipo = $tipo;
        $user->email = $email;

         if ($user->save()){
            $response->getBody()->write(json_encode("Guardado con exito"));
         }else{
            $response->getBody()->write(json_encode("Error al guardar"));
         }
        return $response;
    }  

    public function login($request, $response, $args) {
              
        $req = $request->getParsedBody();

        $nombre = $req["nombre"] ?? null;
        $clave = $req["clave"] ?? null;
        $email = $req["email"] ?? null;

        $userEmail = Usuario::where('email', $email)->first();
        $userClave = Usuario::where('clave', $clave)->first();
        $userNombre = Usuario::where('nombre', $nombre)->first();

        if ($userEmail != null || $userClave != null || $userNombre != null){
            
            $payload = array(
                "iss" => "http://example.org",
                "aud" => "http://example.com",
                "iat" => 1356999524,
                "nbf" => 1357000000,
                "email" => $req->email ?? null,
                "nombre" => $req->nombre ?? null,
            );
            
            $jwt = JWT::encode($payload, "segundoparcial");
            $response->getBody()->write($jwt);
        }else{

            $response->getBody()->write(json_encode("Usuario inexistente"));
        }
        return $response;
    }  

    public function addMateria($request, $response, $args) {
              
        $req = $request->getParsedBody();
        
        $materia = $req["materia"];
        $cupos = $req["cupos"];
        $cuatrimestre = $req["cuatrimestre"];

        $user = new Materia;
        $user->materia = $materia;
        $user->cupos = $cupos;
        $user->cuatrimestre = $cuatrimestre;

         if ($user->save()){
            $response->getBody()->write(json_encode("Guardado con exito"));
         }else{
            $response->getBody()->write(json_encode("Error al guardar"));
         }
        return $response;
    }  
    public function getMaterias( $request, $response, $args)
    {
        $materias = $materia = Materia::get();
        $response->getBody()->write(json_encode($materias));

        return $response;
    }

}