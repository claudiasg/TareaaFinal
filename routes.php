<?php
use Pecee\SimpleRouter\SimpleRouter;
use App\Controllers\HomeController;
use App\Controllers\ProductoController;
use App\Controllers\AuthController;

SimpleRouter::get('/', [HomeController::class, 'index']);
SimpleRouter::get('/login', [AuthController::class, 'showLogin']);
SimpleRouter::post('/login', [AuthController::class, 'login']);
SimpleRouter::get('/logout', [AuthController::class, 'logout']);

SimpleRouter::get('/productos', [ProductoController::class, 'index']);
SimpleRouter::get('/productos/crear', [ProductoController::class, 'crear']);
SimpleRouter::post('/productos/guardar', [ProductoController::class, 'guardar']);
SimpleRouter::get('/productos/editar/{id}', [ProductoController::class, 'editar']);
SimpleRouter::post('/productos/actualizar/{id}', [ProductoController::class, 'actualizar']);
SimpleRouter::post('/productos/eliminar/{id}', [ProductoController::class, 'eliminar']);