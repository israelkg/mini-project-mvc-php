<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Application;
use App\Controllers\HomeController;

define('ROOT_PATH', dirname(__DIR__));

$app = new Application();

//routes
$app->router->get('/', [HomeController::class, 'index']);
$app->router->get('/home', [HomeController::class, 'index']);
$app->router->get('/about', [HomeController::class, 'about']);
$app->router->get('/users', [HomeController::class, 'users']); 
$app->router->get('/users/create', [HomeController::class, 'createUserForm']);       // rota para exibir o formulário de criação de usuário
$app->router->post('/users/create', [HomeController::class, 'storeUser']);           // rota para processar o envio do formulário de criação de usuário
$app->run();

?>