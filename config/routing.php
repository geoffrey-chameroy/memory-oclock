<?php declare(strict_types=1);

use App\Controller\HomeController;
use App\Controller\MemoryController;
use App\Routing\Router;

// Configuration des routes de l'application
$router = new Router();
$router
    ->addRoute('/', 'GET', HomeController::class, 'home')
    ->addRoute('/memory', 'GET', MemoryController::class, 'play')
    ->addRoute('/memory', 'POST', MemoryController::class, 'save');
