<?php

use Core\App;
use Core\Router;
use Core\Request;
use Illuminate\Database\Capsule\Manager as Capsule;


require "vendor/autoload.php";
require __DIR__. 'src/Core/Bootstrap.php';

$db = App::get('config')['database'];

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => $db['type'],
    'host'      => $db['host'],
    'database'  => $db['database'],
    'username'  => $db['user'],
    'password'  => $db['password'],
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);



$capsule->setAsGlobal();
$capsule->bootEloquent();


$rutas = require 'routes.php';


// $url = Request::url();

// $router = new Router;
// $router->registrar($rutas);

// $router->manejar($url);