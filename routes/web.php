<?php
use App\Controllers\HomeController;
use App\Controllers\UserController;
require_once BASE_PATH . 'app/controllers/HomeController.php';
require_once BASE_PATH . 'app/controllers/UserController.php';
$router->get('/', [HomeController::class, 'index']);
$router->get('/user', [UserController::class, 'index']);
$router->get('/alluser', [UserController::class, 'allUser']);
$router->post('/formuser', [UserController::class, 'guardar']);
