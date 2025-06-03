<?php

namespace App\Core;  
use App\Core\Router;

class Application {
    public static Application $app;  

    public Router $router;   

    public function __construct(){
        self::$app = $this;           
        $this->basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));   
        $this->router = new Router();  
    }

    public function run(){
        echo $this->router->resolve();
    }
}