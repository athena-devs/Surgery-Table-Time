<?php 

namespace Src\Core;

class Router
{
    protected $routes = [];

    public function add(string $method, string $uri, array $action) {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'action' => $action,
        ];
    }

    public function dispatch() {
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            $pattern = "#^" . preg_replace('/\{([a-zA-Z0-9_-]+)\}/', '([a-zA-Z0-9_-]+)', $route['uri']) . "$#";
        }

        if (preg_match($pattern, $requestUri, $matches) && $route['method'] === $requestMethod) {
            array_shift($matches);

            [$controller, $method] = $route['action'];

            $controllerInstance = new $controller();
            call_user_func_array([$controllerInstance, $method], $matches);
            return;
        }

        $this->handleNotFound();
    }
    protected function handleNotFound()
    {
        http_response_code(404);
        echo "<h1>404 - Página Não Encontrada</h1>";
    }    
}

?>