<?php

namespace Helpers\Router;

class Router
{
    protected array $routes = [];

    /**
     * Get function
     *
     * @param $uri
     * @param $controller
     * @return void
     */
    public function get($uri, $controller): void
    {
        $this->add($uri, $controller, 'GET');
    }

    /**
     * Post function
     *
     * @param $uri
     * @param $controller
     * @return void
     */
    public function post($uri, $controller): void
    {
        $this->add($uri, $controller, 'POST');
    }

    /**
     * Put function
     *
     * @param $uri
     * @param $controller
     * @return void
     */
    public function put($uri, $controller): void
    {
        $this->add($uri, $controller, 'PUT');
    }

    /**
     * Delete function
     *
     * @param $uri
     * @param $controller
     * @return void
     */
    public function delete($uri, $controller): void
    {
        $this->add($uri, $controller, 'DELETE');
    }

    /**
     * Require route function
     *
     * @param $uri
     * @param $method
     * @return void
     */
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

    /**
     * Add route function
     *
     * @param $uri
     * @param $controller
     * @param $method
     * @return void
     */
    private function add($uri, $controller, $method): void
    {
        $this->routes[] = compact('uri', 'controller', 'method');
    }
}
