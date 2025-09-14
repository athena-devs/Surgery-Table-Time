<?php

use Src\Controllers\HomeController;
use Src\Controllers\MaterialController;
use Src\Controllers\SurgeryController;
use Src\Core\Router;

$router = new Router();

// Home
$router->add('GET', '/', [HomeController::class, 'index']);

// --- Rotas para Materiais ---
$router->add('GET', '/materials/{id}', [MaterialController::class, 'show']);
$router->add('POST', '/materials', [MaterialController::class, 'store']);
$router->add('PUT', '/materials/{id}', [MaterialController::class, 'update']);


// --- Rotas para Cirurgias ---
$router->add('GET', '/surgeries/{id}', [SurgeryController::class, 'show']);
$router->add('POST', '/surgeries', [SurgeryController::class, 'store']);
$router->add('PUT', '/surgeries/{id}', [SurgeryController::class, 'update']);
?>
