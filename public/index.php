<?php declare(strict_types=1);

// Déclarations des classes, utilisation de la norme PSR-4 pour le chargement des classes
use App\Routing\Route;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// Import des dépendances
require dirname(__DIR__) . '/vendor/autoload.php';
// Chargement des variables d'environnement via le fichier .env
$dotenv = new Dotenv();
$dotenv->load(dirname(__DIR__) . '/.env');
// Import du routing
require dirname(__DIR__) . '/config/routing.php';

// On récupère la méthode ainsi que l'uri de la requête
$httpMethod = $_SERVER['REQUEST_METHOD']; // ex: GET | POST
$uri = $_SERVER['REQUEST_URI']; // ex: /memory

// On récupère la route correspondante à la requête
/** @var Route|null $route */
$route = $router->matchRoute($uri, $httpMethod);

// Si aucune route ne correspond, on envoie une page 404
if (!$route) {
    $response = new Response(null, 404);
    $response->send();
    die;
}

// On utilise ici le modèle MVC (Modèle Vue Controleur)
// Un controller doit transformer une requête en réponse

// On récupère tous les éléments de la requête pour pouvoir l'injecter dans le controller
$request = Request::createFromGlobals();
// On récupère le controller de la route et on l'instancie
$controllerName = $route->getController();
$controller = new $controllerName;

// On récupère la fonction de la route et on l'éxécute
$actionName = $route->getAction();
/** @var Response $response */
$response = $controller->$actionName($request);
// On envoie l'affichage du retour de la fonction
$response->send();
