<?php

namespace App\Core;

use App\Core\Application;  //importar a classe Application para poder acessar a instância do Router global.

class Controller{
    /**
     * @param string $view O caminho da view dentro de 'app/Views/' (ex: 'home/index').
     * @param array $params Um array associativo de dados a serem passados para a view.
     * @return string O conteúdo HTML renderizado.
     */
    public function render(string $view, array $params = []): string{
        return Application::$app->router->renderView($view, $params);
    }

    /**
     * @param string $url A URL para a qual redirecionar.
     */
    public function redirect(string $url){
        $fullUrl = Application::$app->basePath . $url;
        header("Location: $fullUrl");
        exit;
    }
}