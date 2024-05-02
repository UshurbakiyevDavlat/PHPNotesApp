<?php

namespace App\Core;

use App\Enums\MethodsEnum;
use App\Middleware\Middleware;

class Router
{
    protected array $routes = [];

    /**
     * Get method
     *
     * @param string $uri
     * @param string $controller
     * @return Router
     */
    public function get(string $uri, string $controller): Router
    {
        return $this->add($uri, $controller, MethodsEnum::HTTP_GET);
    }

    /**
     * Post method
     *
     * @param string $uri
     * @param string $controller
     * @return Router
     */
    public function post(string $uri, string $controller): Router
    {
        return $this->add($uri, $controller, MethodsEnum::HTTP_POST);
    }

    /**
     * Put method
     *
     * @param string $uri
     * @param string $controller
     * @return Router
     */
    public function put(string $uri, string $controller): Router
    {
        return $this->add($uri, $controller, MethodsEnum::HTTP_PUT);
    }

    /**
     * Patch method
     *
     * @param string $uri
     * @param string $controller
     * @return Router
     */
    public function patch(string $uri, string $controller): Router
    {
        return $this->add($uri, $controller, MethodsEnum::HTTP_PATCH);
    }

    /**
     * Delete method
     *
     * @param string $uri
     * @param string $controller
     * @return Router
     */
    public function delete(string $uri, string $controller): Router
    {
        return $this->add($uri, $controller, MethodsEnum::HTTP_DELETE);
    }

    /**
     * Require route method
     *
     * @param string $uri
     * @param string $method
     * @return void
     */
    public function route(string $uri, string $method): void
    {
        foreach ($this->routes as $route) {
            if (
                $route['uri'] === $uri
                &&
                $route['method'] === $method
            ) {

                if ($route['middleware']) {
                    try {
                        Middleware::resolve($route['middleware']);
                    } catch (\Exception $e) {
                        die($e->getMessage());
                    }
                }

                $controller = $route['controller'];
                require base_path('App/Http/Controllers' . $controller);
                break;
            }
        }
    }

    /**
     * Add route method
     *
     * @param string $uri
     * @param string $controller
     * @param string $method
     * @return Router
     */
    private function add(string $uri, string $controller, string $method): Router
    {
        $middleware = null;

        $this->routes[] = compact(
            'uri',
            'controller',
            'method',
            'middleware',
        );

        return $this;
    }

    /**
     * Method for restrict route with middleware
     *
     * @param string $key
     * @return void
     */
    public function only(string $key): void
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;
    }
}
