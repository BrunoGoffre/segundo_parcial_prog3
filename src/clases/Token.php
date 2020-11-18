<?php

namespace Aplicacion\Token;
require __DIR__."/../vendor/autoload.php";

use \Firebase\JWT\JWT;

class Token{
  
  public static function GenerarToken($email,$tipo){
    $payload = array(
      "iss" => "http://example.org",
      "aud" => "http://example.com",
      "iat" => 1356999524,
      "nbf" => 1357000000,
      "email" => $email,
      "tipo" => $tipo
    );
    return JWT::encode($payload, "primerparcial");
  }
  
  public static function AutenticarToken($jwt){
    try {
      $decode = JWT::decode($jwt,"primerparcial", array('HS256'));
      return  $decode;
      
    } catch (\Throwable $th) {
      return false;
    }
  }
}
  //function DecodeJWT  ()
  // $decoded = JWT::decode($jwt, $key, array('HS256'));
  // print_r($decoded);

// /*
//  NOTE: This will now be an object instead of an associative array. To get
//  an associative array, you will need to cast it as such:
// */

// $decoded_array = (array) $decoded;

// /**
//  * You can add a leeway to account for when there is a clock skew times between
//  * the signing and verifying servers. It is recommended that this leeway should
//  * not be bigger than a few minutes.
//  *
//  * Source: http://self-issued.info/docs/draft-ietf-oauth-json-web-token.html#nbfDef
//  */
// JWT::$leeway = 60; // $leeway in seconds
// $decoded = JWT::decode($jwt, $key, array('HS256'));