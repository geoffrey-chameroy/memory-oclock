<?php declare(strict_types=1);

namespace App\Routing;

class Router
{
    private array $routes = [];

    public function addRoute(string $uri, string $method, string $controller, string $action): self
    {
        $route = new Route($uri, $method, $controller, $action);
        $this->routes[] = $route;

        return $this;
    }

    public function matchRoute(string $uri, string $method): ?Route
    {
        $matchedRoutes = array_filter($this->routes, function(Route $route) use ($uri, $method) {
            return $route->getUri() === $uri && $route->getMethod() === $method;
        });

        return count($matchedRoutes) > 0 ? array_shift($matchedRoutes) : null;
    }
}
