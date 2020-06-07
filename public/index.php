<?php declare(strict_types=1);

use App\Routing\Route;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require dirname(__DIR__) . '/vendor/autoload.php';
// Load environment variable from .env file
$dotenv = new Dotenv();
$dotenv->load(dirname(__DIR__) . '/.env');
require dirname(__DIR__) . '/config/routing.php';

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

/** @var Route|null $route */
$route = $router->matchRoute($uri, $httpMethod);

if (!$route) {
    $response = new Response(null, 404);
    $response->send();
    die;
}

$request = Request::createFromGlobals();
$controllerName = $route->getController();
$controller = new $controllerName;

$actionName = $route->getAction();
/** @var Response $response */
$response = $controller->$actionName($request);
$response->send();
