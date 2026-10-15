<?php
// Defenir Const
define('BASE_PATH', realpath(__DIR__ . '/../') . DIRECTORY_SEPARATOR);


require_once BASE_PATH . 'core/Router.php';


if (file_exists(BASE_PATH . 'vendor/autoload.php')) {
    require_once BASE_PATH . 'vendor/autoload.php';
}

if (class_exists('Dotenv\Dotenv')) {
    $dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
    $dotenv->load();
}
// Cargar el objeto del enrutador 
use Core\Router;
$router = new Router();
require_once BASE_PATH . 'routes/web.php';
$router->resolve();
