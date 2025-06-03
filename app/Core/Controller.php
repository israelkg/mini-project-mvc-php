<?php

namespace App\Core;

use App\Core\Application;  

class Controller{
    /**
     * @param string $view 
     * @param array $params
     * @return string 
     */
    public function render(string $view, array $params = []): string{
        return Application::$app->router->renderView($view, $params);
    }

    /**
     * @param string $url
     */
    public function redirect(string $url){
        $fullUrl = Application::$app->basePath . $url;
        header("Location: $fullUrl");
        exit;
    }
}