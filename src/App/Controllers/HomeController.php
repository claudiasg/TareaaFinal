<?php
namespace App\Controllers;

use App\Models\Producto;

class HomeController {
    public function index() {
        $productos = Producto::all();
        require 'views/index.view.php';
    }
}