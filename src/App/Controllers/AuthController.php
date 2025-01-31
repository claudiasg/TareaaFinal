<?php
namespace App\Controllers;

use App\Models\Usuario;
use Core\Auth;

class AuthController {
    public function showLogin() {
        require 'views/login.view.php';
    }

    public function login() {
        $usuario = Usuario::where('email', $_POST['email'])->first();
        if ($usuario && password_verify($_POST['password'], $usuario->password)) {
            Auth::login($usuario);
            header('Location: /productos');
        } else {
            echo "Credenciales incorrectas";
        }
    }

    public function logout() {
        Auth::logout();
        header('Location: /login');
    }
}