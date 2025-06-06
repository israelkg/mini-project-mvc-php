<?php

namespace App\Core;

use App\Core\Router;
use App\Core\Request;
use App\Core\Response;

class Application
{
    public static Application $app;
    public static string $ROOT_DIR; 

    public Router $router;
    public Request $request;
    public Response $response;
    public string $basePath; 

    /**
     * @param string $rootPath 
     */
    public function __construct(string $rootPath)
    {
        self::$ROOT_DIR = $rootPath; 
        self::$app = $this;        

        $scriptName = $_SERVER['SCRIPT_NAME'];
        $documentRoot = $_SERVER['DOCUMENT_ROOT'];

        $projectPathRelativePublic = str_replace('\\', '/', realpath($rootPath . '/public')); 
        
        $this->basePath = substr($scriptName, strlen($documentRoot));
        $this->basePath = rtrim(str_replace('index.php', '', $this->basePath), '/');

        if ($this->basePath === '/public' || $this->basePath === '/') {
            $this->basePath = '';
        }
        if ($this->basePath !== '') {
            $this->basePath = rtrim($this->basePath, '/');
        }

        $this->request = new Request();
        $this->response = new Response();

        $this->router = new Router($this->request, $this->response, $this);
    }

    /**
     * @return void
     */
    public function run(): void
    {
        echo $this->router->resolve();
    }
}