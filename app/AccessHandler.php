<?php
/**
 * Created by PhpStorm.
 * User: Denny
 * Date: 20/09/2015
 * Time: 12:10
 */

namespace App;


class AccessHandler
{

    protected static $hierarchy = [
        'admin' => 3,
        'editor'=> 2,
        'user'  => 1
    ];

    //$userRole es el rol actual de user conectado
    //$requiredRole vendria siendo el rol minimo requerido para que pase
    public static function check($userRole, $requiredRole)
    {
        return static::$hierarchy[$userRole]>= static::$hierarchy[$requiredRole];
    }

}