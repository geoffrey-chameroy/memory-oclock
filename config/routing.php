<?php declare(strict_types=1);

use App\Controller\HomeController;
use App\Controller\MemoryController;
use App\Routing\Router;

$router = new Router();
$router->addRoute('/', 'GET', HomeController::class, 'home');
$router->addRoute('/memory', 'GET', MemoryController::class, 'play');
$router->addRoute('/memory', 'POST', MemoryController::class, 'save');
