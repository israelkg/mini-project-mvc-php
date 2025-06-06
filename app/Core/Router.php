<?php

namespace App\Core;

use App\Core\Application;
use App\Core\Request;   
use App\Core\Response; 

class Router{
    protected array $routes = [];
    public Request $request;
    public Response $response;
    public Application $app;

    public function __construct(Request $request, Response $response, Application $app){
        $this->request = $request;
        $this->response = $response;
        $this->app = $app;
    }

    public function get(string $path, $callback){
        $this->routes['get'][$path] = $callback;
    }

    public function post(string $path, $callback){
        $this->routes['post'][$path] = $callback;
    }

    public function resolve(){
        $path = $this->request->getPath(); 
        
        $appBasePath = $this->app->basePath; 
        
        if ($appBasePath !== '' && strpos($path, $appBasePath) === 0) {
            $path = substr($path, strlen($appBasePath));
        }

        if ($path === '' || $path === false) { 
            $path = '/';
        }
        
        $method = strtolower($_SERVER['REQUEST_METHOD']);

        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            $this->response->setStatusCode(404); 
            return $this->renderView('_404'); 
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            /** @var \App\Core\Controller $controller */ 
            $controller = new $callback[0]();
            
            $controller->setRequest($this->request); 
            $controller->setResponse($this->response);
            
            $callback[0] = $controller; 
        }

        return call_user_func($callback, $this->request, $this->response);
    }

    public function renderView(string $view, array $params = []){
        foreach ($params as $key => $value) {
            $$key = $value;
        }
          
        $basePath = $this->app->basePath; 
        
        ob_start();
        $viewPath = Application::$ROOT_DIR . "/app/Views/$view.php"; 
        if (!file_exists($viewPath)) {
            throw new \Exception("View '{$view}.php' não encontrada em: " . $viewPath);
        }
        include_once $viewPath; 
        $content = ob_get_clean();

        ob_start();
        $layoutPath = Application::$ROOT_DIR . "/app/Views/layout/main.php"; 
        if (!file_exists($layoutPath)) {
            throw new \Exception("Layout 'main.php' não encontrado em: " . $layoutPath);
        }
        include_once $layoutPath; 
        $layoutOutput = ob_get_clean();
    
        return $layoutOutput; 
    }
}