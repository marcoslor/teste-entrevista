<?php

namespace TesteApp\App;


class Router
{
    public $routes;

    public function on($method, $path, $callback)
    {
        //cria uma rota em REGEX
        $uri = strpos($path, '/') !== 0 ? '/' . $path : $path;
        $pattern = str_replace('/', '\/', $uri);
        $route = '/^' . $pattern . '$/';

        $this->routes[$method][$route] = $callback;

        return $this;
    }

    public function before($callback): Router
    {
        $callback();
        return $this;
    }

    public function run($method, $uri)
    {
        if (!isset($this->routes[$method])) {
            return null;
        }

        //procura por rota que corresponda ao URI
        foreach ($this->routes[$method] as $route => $callback) {

            if (preg_match($route, $uri, $parameters)) {
                array_shift($parameters);
                return call_user_func_array($callback, $parameters);
            }
        }
        return null;
    }
}