<?php

namespace Helpers\Router;

class Router
{
    protected $routes = [];

    public function get($uri, $controller): void
    {
        $this->add($uri, $controller, 'GET');
    }

    public function post($uri, $controller): void
    {
        $this->add($uri, $controller, 'POST');
    }

    public function put($uri, $controller): void
    {
        $this->add($uri, $controller, 'PUT');
    }

    public function delete($uri, $controller): void
    {
        $this->add($uri, $controller, 'DELETE');
    }

    public function route($uri, $method): void
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {
                $controller = $route['controller'];
                require base_path($controller);
                break;
            }
        }
    }

    private function add($uri, $controller, $method): void
    {
        $this->routes[] = compact('uri', 'controller', 'method');
    }
}
