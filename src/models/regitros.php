<?php
namespace Aplicacion\models;

use Illuminate\Database\Eloquent\Model;

class regitros extends Model{
    protected $table = "users";
    public $timestamps = false;
    //protected $table = "datos"; //forzar una tabla especifica y que no lea user por default
   // protected $primaryKey = ""; // esatblecer primarykey
    
    
}