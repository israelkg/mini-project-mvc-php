<?php

namespace App\Core;

use App\Core\Application; 
use App\Core\Request; 
use App\Core\Response; 

class Controller{
    protected Request $request;
    protected Response $response;

    public function setRequest(Request $request): void {
        $this->request = $request;
    }

    public function setResponse(Response $response): void {
        $this->response = $response;
    }

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
     * @return void
     */
    public function redirect(string $url): void{ 
        $fullUrl = Application::$app->basePath . $url;
        $this->response->redirect($fullUrl); 
    }
}