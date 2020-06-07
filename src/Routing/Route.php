<?php declare(strict_types=1);

namespace App\Routing;

class Route
{
    private string $uri;
    private string $method;
    private string $controller;
    private string $action;

    public function __construct(string $uri, string $method, string $controller, string $action)
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->controller = $controller;
        $this->action = $action;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getAction(): string
    {
        return $this->action;
    }
}
