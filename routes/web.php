<?php
use App\Controllers\HomeController;
use App\Controllers\UserController;
require_once BASE_PATH . 'app/controllers/HomeController.php';
require_once BASE_PATH . 'app/controllers/UserController.php';
$router->get('/', [HomeController::class, 'index']);
$router->get('/formuser/crear', [UserController::class, 'index']);
$router->get('/formuser/iniciar', [UserController::class, 'iniciar']);
$router->get('/alluser', [UserController::class, 'allUser']);
$router->post('/formuser', [UserController::class, 'guardar']);
$router->post('/formuseriniciar', [UserController::class, 'iniciarcuenta']);
