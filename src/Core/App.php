<?php

namespace Core;

class App
{
    protected static $dependencias = [];

    // guardar dependencia
    public static function set($llave, $valor)
    {
        static::$dependencias[$llave] = $valor;
    }

    // recuperar dependencia
    public static function get($llave)
    {
        if (!array_key_exists($llave, static::$dependencias)) {
            throw new Exception("No se ha encontrado la dependencia para la llave {$llave}");
        }

        return static::$dependencias[$llave];
    }
}
