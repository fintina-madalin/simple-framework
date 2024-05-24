<?php

namespace App\Core;

use App\Core\Exceptions\RouterException;

class Router
{
    public array $routes = [];

    public function add(array $methods, string $path, $handler): void
    {
        foreach ($methods as $method) {
            $this->routes[] = compact('method', 'path', 'handler');
        }
    }

    public function dispatch(string $requestUri, string $requestMethod): mixed
    {
        $request = new Request();

        foreach ($this->routes as $route) {
            if (in_array($requestMethod, (array)$route['method']) && $route['path'] === $requestUri) {
                $handler = $route['handler'];
                if (is_array($handler)) {
                    $controller = new $handler[0]($request);
                    return call_user_func([$controller, $handler[1]]);
                }
                return call_user_func($handler, $request);
            }
        }
        throw new RouterException('No route found for ' . $requestMethod . ' ' . $requestUri);
    }
}
