<?php

namespace Core;

use App\Models\Usuario;

class Auth
{
    public static function login($correo, $password)
    {
        $usuario = Usuario::where('correo', $correo)->first();
        //dd(password_verify($password, $usuario[0]->password));

        if (!empty($usuario) and password_verify($password, $usuario->password)) {
            static::inicializarSesion();

            $_SESSION['correo'] = $usuario->correo;
            $_SESSION['nombre'] = $usuario->nombre;
            $_SESSION['id'] = $usuario->id;

            return true;
        }
        return false;
    }

    public static function verificar()
    {
        static::inicializarSesion();

        if (empty($_SESSION['id'])) {
            return false;
        }

        return true;
    }

    public static function inicializarSesion()
    {
        if (empty(session_id())) {
            session_start();
        }
    }

    public static function salir()
    {
        session_start();
        session_destroy();
    }
}
