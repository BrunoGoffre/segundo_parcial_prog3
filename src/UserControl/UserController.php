<?php
namespace Aplicacion\Controller;

use Aplicacion\models\regitros;
use Illuminate\Contracts\Routing\Registrar;

class UserController{
   public function addUser($request, $response, $args) {
        $id = $args['id'];
        $user = regitros::where('id',$id)->first();

        $user->email = "marina";
        $rta = $user->save();        
        $response->getBody()->write(json_encode($user));
        return $response;
    }  
    public function getAll($request, $response, $args) {
        $rta = regitros::get();
        
        $response->getBody()->write(json_encode($rta));
        return $response;
    }
    public function delete($request, $response, $args) {
        $id = $args['id'];
        $user = regitros::where('id',$id)->first();
        $rta = $user->delete();
        
        $response->getBody()->write(json_encode($rta));
        return $response;
    }
    public function addUsuario($request, $response, $args) {
        $user = new regitros;
        $user->email="Bruno";
        $user->tipo = "admin";
        $user->password = "123";
        $user->foto = "foto";
        
        $rta = $user->save();

        $response->getBody()->write(json_encode($rta));
        return $response;
    }
    
}