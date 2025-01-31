<?php

namespace Core\Database;

use PDO;
use PDOException;

class Conexion
{
    public static function dbConectar($config, $mostrarErrores)
    {
        try {
            return new PDO("{$config['type']}:host={$config['host']};dbname={$config['database']}", $config['user'], $config['password']);
        } catch (PDOException $error) {
            $mensaje = ($mostrarErrores) ? $error->getMessage() : '';
            die($mensaje);
        }
    }
}
