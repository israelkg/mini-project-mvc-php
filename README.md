# 👨‍💻 Projeto: MVC PHP Puro

Este é um projeto de estudo para construir um framework **MVC (Model-View-Controller)** simples em **PHP puro**, do zero. O objetivo é compreender os princípios fundamentais da arquitetura MVC, como roteamento, manipulação de requisições e respostas, e renderização de views, sem depender de frameworks externos complexos como Symfony ou Laravel.

---

## 📚 Índice

* 📄 [Descrição Detalhada](#-descrição-detalhada)
* ✨ [Funcionalidades](#-funcionalidades)
* ⚙️ [Tecnologias Usadas](#-tecnologias-usadas)
* 📌 [Pré-requisitos](#-pré-requisitos)
* 📦 [Instalação](#-instalação)
* 🚀 [Como Usar](#-como-usar)
* 💡 [Conceitos Chave Implementados](#-conceitos-chave-implementados)
* 🤝 [Contribuição](#-contribuição)

---

## 📄 Descrição Detalhada

Este projeto é uma aplicação web minimalista que serve como um ponto de partida para entender como um framework MVC funciona internamente. Ele foi desenvolvido com foco nos seguintes conceitos:

* **Roteamento Personalizado**: O `Router` mapeia URLs para controladores e ações específicas.
* **Controle de Requisições/Respostas**: Classes dedicadas (`Request` e `Response`) encapsulam a interação com o ambiente HTTP.
* **Separação de Responsabilidades (MVC)**:
    * **Model**: (Ainda a ser implementado ou simplificado, mas a estrutura permite sua adição futura).
    * **View**: Arquivos PHP simples (`.php`) para a camada de apresentação, com um layout principal (`main.php`).
    * **Controller**: Classes que lidam com a lógica de negócio, interagem com Models e selecionam Views para renderizar.
* **Injeção de Dependências**: O sistema central (`Application`) injeta `Request`, `Response` e a si mesmo no `Router`, que por sua vez injeta `Request` e `Response` nos Controladores.

---

## ✨ Funcionalidades

Atualmente, o projeto oferece a base para:

* **Roteamento**: Mapeia URLs para controladores/métodos ou para views diretas (para páginas estáticas).
* **Tratamento de Requisições**: Captura o método HTTP (GET/POST) e os dados da URL/formulário.
* **Geração de Respostas**: Define o status HTTP (ex: `404 Not Found`) e executa redirecionamentos.
* **Renderização de Views**: Inclui views específicas dentro de um layout principal (`main.php`), permitindo a passagem de dados para a view.
* **Gerenciamento de Caminho Base**: Lida automaticamente com o caminho base da aplicação, garantindo que os links funcionem corretamente em subdiretórios.

---

## ⚙️ Tecnologias Usadas

* **PHP 8.1+**: Linguagem de programação principal.
* **Composer**: Gerenciador de dependências PHP (usado apenas para o autoloader, se preferir, ou pode-se usar um autoloader manual).
* **HTML & CSS Puro**: Para a estrutura e estilização básica das views.
* **Git & GitHub**: Ferramentas para controle de versão e hospedagem.

---

## 📌 Pré-requisitos

Para rodar este projeto localmente, você precisará ter as seguintes ferramentas instaladas:

* **PHP 8.1+** (com as extensões padrão).
* Um **servidor web local** (ex: Apache com `mod_rewrite` habilitado, ou Nginx).
* **Opcional: Composer**, se você preferir usar seu autoloader. Caso contrário, um autoloader manual pode ser implementado no `index.php`.

---

## 📦 Instalação

Siga os passos abaixo para configurar o ambiente e rodar o projeto:

1.  **Clone o Repositório**:

    ```bash
    git clone [https://github.com/SEU_USUARIO/NOME_DO_REPOSITORIO.git](https://github.com/SEU_USUARIO/NOME_DO_REPOSITORIO.git)
    cd NOME_DO_REPOSITORIO
    ```

    *(Lembre-se de substituir `SEU_USUARIO` e `NOME_DO_REPOSITORIO` pelos dados reais do seu repositório no GitHub).*

2.  **Instale as Dependências do Composer (Opcional, se estiver usando)**:

    ```bash
    composer install
    ```

    *Se você não usar Composer, você precisará de um autoloader manual no `public/index.php` para carregar suas classes (`App\Core\*` e `App\Controllers\*`).*

3.  **Configurar o Servidor Web**:

    * **Apache**:
        Certifique-se de que o `DocumentRoot` do seu Virtual Host ou a configuração de alias aponte para a pasta `public/` do projeto. Verifique também se o `mod_rewrite` está habilitado e se existe um arquivo `.htaccess` na sua pasta `public/`.

        **`public/.htaccess`**:

        ```apache
        <IfModule mod_rewrite.c>
            RewriteEngine On
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteCond %{REQUEST_FILENAME} !-d
            RewriteRule ^(.*)$ index.php [QSA,L]
        </IfModule>
        ```

    * **Servidor PHP Embutido**:
        Para testes rápidos, você pode usar o servidor embutido do PHP (não recomendado para produção):

        ```bash
        php -S 127.0.0.1:8000 -t public/
        ```

---

## 🚀 Como Usar

Com a instalação e configuração do servidor concluídas, siga estes passos para iniciar e interagir com a aplicação:

1.  **Inicie o Servidor de Desenvolvimento**:
    * Se estiver usando Apache/Nginx, certifique-se de que o servidor está rodando.
    * Se estiver usando o servidor embutido do PHP:

        ```bash
        php -S 127.0.0.1:8000 -t public/
        ```

        Você deverá ver uma mensagem indicando que o servidor está escutando na porta `127.0.0.1:8000`.

2.  **Acesse a Aplicação no Navegador**:
    Abra seu navegador e acesse a URL configurada para seu projeto.
    * **Exemplos**: `http://localhost/` ou `http://127.0.0.1:8000/` (se usar o servidor embutido).

    Tente acessar as rotas definidas no seu `public/index.php`:
    * `http://localhost/` ou `/home` (para a Home Page)
    * `http://localhost/about` (para a página Sobre Nós)
    * `http://localhost/users`
    * `http://localhost/users/create` (formulário de criação de usuário)
    * Tente uma URL inexistente para ver a página `404`.

---


## 💡 Conceitos Chave Implementados

* **Front Controller**: Todas as requisições são direcionadas para um único ponto de entrada (`public/index.php`).
* **Injeção de Dependências**: As classes (`Router`, `Controller`) recebem as dependências (`Request`, `Response`, `Application`) via seus construtores ou métodos setter, promovendo código mais testável e organizado.
* **Buffer de Saída (`ob_start()`)**: Usado na renderização de views para capturar o output HTML das views e layouts antes de enviá-lo ao navegador.
* **Design Patterns Simples**: O padrão **Singleton** é usado na classe `Application` (`Application::$app`) para acesso global à instância da aplicação.

---

## 🤝 Contribuição

Este projeto é ideal para estudo e aprimoramento em PHP puro e na arquitetura MVC. Sinta-se à vontade para explorar o código, sugerir melhorias ou adicionar novas funcionalidades!

1.  Faça um **fork** do projeto.
2.  Crie uma nova branch para sua feature:
    ```bash
    git checkout -b minha-nova-feature
    ```
3.  Faça suas mudanças e commits:
    ```bash
    git commit -m 'feat: Adiciona nova funcionalidade'
    ```
4.  Envie para o seu fork:
    ```bash
    git push origin minha-nova-feature
    ```
5.  Abra um **Pull Request** no repositório original, descrevendo suas mudanças.
