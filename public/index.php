<?php declare(strict_types=1);

use App\Controller\HomeController;
use App\Controller\MemoryController;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require dirname(__DIR__) . '/vendor/autoload.php';
// Load environment variable from .env file
$dotenv = new Dotenv();
$dotenv->load(dirname(__DIR__) . '/.env');

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// @todo: improve with a router
switch ($uri) {
    case '/':
        $controller = HomeController::class;
        $action = 'home';
        break;
    case '/memory':
        if ($httpMethod === 'GET') {
            $controller = MemoryController::class;
            $action = 'play';
        } else if ($httpMethod === 'POST') {
            $controller = MemoryController::class;
            $action = 'save';
        }
        break;
    default:
        $controller = '';
        $action = '';
        break;
}

if ($controller === '' || $action === '') {
    $response = new Response(null, 404);
    $response->send();
    die;
}

$request = Request::createFromGlobals();
$controller = new $controller;
/** @var Response $response */
$response = $controller->$action($request);
$response->send();
