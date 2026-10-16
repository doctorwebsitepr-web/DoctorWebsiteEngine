<?php
use App\Controllers\HomeController;
use App\Controllers\UserController;
require_once BASE_PATH . 'app/controllers/HomeController.php';
require_once BASE_PATH . 'app/controllers/UserController.php';
$router->get('/', [HomeController::class, 'index']);

// Empieza User
$router->get('/user/formusercrear', [UserController::class, 'crearUserForm']);
$router->post('/user/formuserfuncioncrear', [UserController::class, 'crearUserPost']);

$router->get('/user/formuseriniciar', [UserController::class, 'iniciarUserForm']);
$router->post('/user/formuserfuncioniniciar', [UserController::class, 'iniciarUserPost']);

$router->get('/user/formuserverificar', [UserController::class, 'verificarUserForm']);
$router->post('/user/formuserfuncionverificar', [UserController::class, 'verificarUserPost']);

$router->get('/user/alluser', [UserController::class, 'allUser']);
// Termina User
