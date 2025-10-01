<?php
namespace App\Traits;

trait RegExTrait{

    //Esta funcion verifica si el string que se pasa por parametro, no cuenta con caracteres especiales
    public static function sinCaracteresEspeciales($cadena){
        if(preg_match('/[^a-zA-Z]+/',$cadena)){
            return back()->with("error","Este texto contiene caracteres que no corresponden");
        }
    }
}