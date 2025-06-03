<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Página Inicial do Meu Projeto MVC',
            'greeting' => 'Bem-vindo ao seu projeto MVC em PHP do zero!'
        ];
        return $this->render('home/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'Sobre Nós - Meu Projeto MVC',
            'content' => 'Esta é a página "Sobre Nós" do nosso projeto MVC básico.'
        ];
        return $this->render('home/about', $data);
    }

    /**
     * listar usuários, usando o Model.
     * corresponde à rota '/users'.
     */
    public function users()
    {
        // instancia o model de usuário.
        $userModel = new User();

        // 2. O Controller pede os dados ao Model. O Controller não se preocupa
        //    com 'como' os dados são obtidos (se é de um array, DB, API, etc.).
        $users = $userModel->getAllUsers();

        //prepara os dados para a View.
        $data = [
            'title' => 'Lista de Usuários',
            'users' => $users //passa o array de usuários para a View
        ];

        //decide qual View exibir e a renderiza com os dados.
        return $this->render('home/users', $data);
    }

    public function createUserForm(){
        return $this->render('home/create-user', ['title' => 'Cadastrar Novo Usuário']);
    }

    public function storeUser(){
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $role = $_POST['role'] ?? '';

        //armazenar as mensagens de erro de validação
        $errors = [];

        if (empty($name)) $errors[] = 'O campo Nome é obrigatório.';

        if (empty($email)) {
            $errors[] = 'O campo Email é obrigatório.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'O formato do Email é inválido.';
        }

        $allowedRoles = ['user', 'editor', 'admin'];
        if (!in_array($role, $allowedRoles)) {
            $errors[] = 'O cargo selecionado é inválido.';
        }

    
        if (empty($errors)) {
            //salvando o usuario
            $userModel = new User();

            // dados para o Model
            $userData = [
                'name' => $name,
                'email' => $email,
                'role' => $role
            ];

            $userModel->addUser($userData);
            return $this->redirect('/users');    //redireciona para a pagina de users

        } else {
            $oldData = [
                'name' => $name,
                'email' => $email,
                'role' => $role
            ];

            $data = [
                'title' => 'Cadastrar Novo Usuário',
                'errors' => $errors, //erros para a View
                'old' => $oldData   //dados antigos para a View re-popular os campos
            ];
            return $this->render('home/create-user', $data);
        }
    }
}