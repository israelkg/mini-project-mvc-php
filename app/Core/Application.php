<?php

namespace App\Core;   //define o namespace da classe

// Importamos a classe Router que também estará no namespace App\Core
use App\Core\Router;

class Application {
    // Isso permite acessar a aplicação de qualquer lugar do código.

    public static Application $app;   // $app sera uma instância da própria classe aplication

    public Router $router;   //propriedade router, que será uma instância da classe Router.

    public function __construct(){
        self::$app = $this;            // Atribui a instância atual da Application à propriedade estática $app.
        $this->basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));   
        $this->router = new Router();  // Instancia o Router. O Router será responsável por lidar com as rotas.
    }

    // O método run é chamado do index.php para iniciar o processamento da requisição.
    public function run(){
        // O Router resolve a URL atual e retorna o conteúdo (HTML, etc.).
        // Este conteúdo é então impresso no navegador.
        echo $this->router->resolve();
    }
}