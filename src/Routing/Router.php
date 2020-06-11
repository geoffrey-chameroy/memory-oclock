<?php declare(strict_types=1);

namespace App\Routing;

class Router
{
    private array $routes = [];

    /**
     * Permet de configurer une route
     *
     * @param string $uri URI de la requête ex: /memory
     * @param string $method Méthode de la requête ex: GET
     * @param string $controller Controleur de l'application ex: MemoryController
     * @param string $action Méthode de l'application ex: Play
     *
     * @return $this Retourne l'instance courante pour permettre de "chaîner" les éxécutions de méthodes
     */
    public function addRoute(string $uri, string $method, string $controller, string $action): self
    {
        $route = new Route($uri, $method, $controller, $action);
        $this->routes[] = $route;

        return $this;
    }

    /**
     * Tente de trouver une correspondance entre les routes paramétres et la route demandée
     *
     * @param string $uri URI de la requête ex: /memory
     * @param string $method Méthode de la requête ex: GET
     * @return Route|null Retourne la route correspondante ou null
     */
    public function matchRoute(string $uri, string $method): ?Route
    {
        // Parcours la liste des routes paramétrées pour rechercher une correspondance
        $matchedRoutes = array_filter($this->routes, function(Route $route) use ($uri, $method) {
            return $route->getUri() === $uri && $route->getMethod() === $method;
        });

        // Si plusieurs routes correspondent, retourne la première de la liste
        return count($matchedRoutes) > 0 ? array_shift($matchedRoutes) : null;
    }
}
