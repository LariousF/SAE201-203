<?php

namespace App\Core;

class Router {
    private $routes = [];
    private $notFoundCallback;

    public function addRoute($method, $path, $callback) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'callback' => $callback
        ];
    }

    public function get($path, $callback) {
        $this->addRoute('GET', $path, $callback);
    }

    public function post($path, $callback) {
        $this->addRoute('POST', $path, $callback);
    }

    public function setNotFound($callback) {
        $this->notFoundCallback = $callback;
    }

    public function handleRequest() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Supprimer le chemin de base si nécessaire
        $basePath = '/SAE201-203/public';
        if (strpos($path, $basePath) === 0) {
            $path = substr($path, strlen($basePath));
        }

        foreach ($this->routes as $route) {
            if ($route['method'] === $method) {
                $pattern = $this->convertPathToRegex($route['path']);
                if (preg_match($pattern, $path, $matches)) {
                    array_shift($matches); // Supprimer la correspondance complète
                    return call_user_func_array($route['callback'], $matches);
                }
            }
        }

        if ($this->notFoundCallback) {
            return call_user_func($this->notFoundCallback);
        }

        http_response_code(404);
        return 'Page non trouvée';
    }

    private function convertPathToRegex($path) {
        return '#^' . preg_replace('#\{([a-zA-Z0-9_]+)\}#', '([^/]+)', $path) . '$#';
    }
} 