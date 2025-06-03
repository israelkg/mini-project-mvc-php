<?php

namespace App\Core;

use App\Core\Application;

class Router{
    protected array $routes = [];

    public function get(string $path, $callback){
        $this->routes['get'][$path] = $callback;
    }

    public function post(string $path, $callback){
        $this->routes['post'][$path] = $callback;
    }

    public function resolve(){
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if ($position !== false) {
            $path = substr($path, 0, $position);
        }

        // ajuste
        $basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])); 
        if (strpos($path, $basePath) === 0) {
            $path = substr($path, strlen($basePath));
        }

        if ($path === '') {
            $path = '/';
        }

        
        $method = strtolower($_SERVER['REQUEST_METHOD']);

        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            http_response_code(404);
            return "<h1>404 Not Found</h1>";
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            $controller = new $callback[0]();
            $callback[0] = $controller;
        }

        return call_user_func($callback);
    }

    public function renderView(string $view, array $params = []){
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        $basePath = Application::$app->basePath;
        
        ob_start();
        include_once ROOT_PATH . "/app/Views/$view.php";
        $content = ob_get_clean();

        include_once ROOT_PATH . "/app/Views/layout/main.php";
        return ob_get_clean();
    }
}