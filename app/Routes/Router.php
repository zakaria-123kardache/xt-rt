<?php
namespace App\Routes;

use App\Routes\Route;

class Router
{
    private $url;
    private $routes = [];

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function get($path, $callable)
    {
        $route = new Route($path, $callable);
        $this->routes['GET'][] = $route;
    }

    public function post($path, $callable)
    {
        $route = new Route($path, $callable);
        $this->routes['POST'][] = $route;
    }

    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($this->url, PHP_URL_PATH);

        foreach ($this->routes[$method] as $route) {
            $matches = [];
            if ($this->matchRoute($route->path, $path, $matches)) {
                $callable = $route->callable;
                $controller = new $callable[0]();
                $methodName = $callable[1];

                if ($method === 'POST' ) {
                
                    $postData = $_POST;
                    $args = array_merge($matches, [$postData]);
                    call_user_func_array([$controller, $methodName], $args); 
                } else {
                    
                    call_user_func_array([$controller, $methodName], $matches); 
                }
                return;
            }
        }
        $this->abort(404);
    }



    private function matchRoute($routePath, $requestPath, &$matches)
    {
        $routePath = rtrim($routePath, '/');
        $requestPath = rtrim($requestPath, '/');

        $routeSegments = explode('/', $routePath);
        $requestSegments = explode('/', $requestPath);

        if (count($routeSegments) !== count($requestSegments)) {
            return false;
        }

        foreach ($routeSegments as $key => $routeSegment) {
            if (isset($requestSegments[$key])) {
                if (!empty($routeSegment) && $routeSegment[0] === '{' && strlen($routeSegment) > 1 && $routeSegment[strlen($routeSegment) - 1] === '}') {
                    $matches[] = $requestSegments[$key];
                    continue;
                }

                if ($routeSegment !== $requestSegments[$key]) {
                    return false;
                }
            } else {
                return false; 
            }
        }

        return true;
    }

    private function abort($code = 404)
    {
        http_response_code($code);
        require __DIR__ . "/../../resources/views/{$code}.php";
        die();
    }
}
