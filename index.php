<?php

use App\Controller\IndexController;
use App\Routes\Router;

require './vendor/autoload.php';
session_start();

$router = new Router($_SERVER['REQUEST_URI']);



// routes 
$router->get('/', [IndexController::class, 'index']);
$router->get('/home',[IndexController::class, 'home']);




$router->run();
