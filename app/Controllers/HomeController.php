<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class HomeController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Página Inicial do Meu Projeto MVC',
            'greeting' => 'Bem-vindo ao seu projeto MVC em PHP do zero!'
        ];
        return $this->render('home/index', $data);
    }

    public function about(){
        $data = [
            'title' => 'Sobre Nós - Meu Projeto MVC',
            'content' => 'Esta é a página "Sobre Nós" do nosso projeto MVC básico.'
        ];
        return $this->render('home/about', $data);
    }

    public function users(){
        $userModel = new User();

        $users = $userModel->getAllUsers();

        $data = [
            'title' => 'Lista de Usuários',
            'users' => $users
        ];

        return $this->render('home/users', $data);
    }

    public function createUserForm(){
        return $this->render('home/create-user', ['title' => 'Cadastrar Novo Usuário']);
    }

    public function storeUser(){
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $role = $_POST['role'] ?? '';

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
            $userModel = new User();

            $userData = [
                'name' => $name,
                'email' => $email,
                'role' => $role
            ];

            $userModel->addUser($userData);
            return $this->redirect('/users');    

        } else {
            $oldData = [
                'name' => $name,
                'email' => $email,
                'role' => $role
            ];

            $data = [
                'title' => 'Cadastrar Novo Usuário',
                'errors' => $errors, 
                'old' => $oldData   
            ];
            return $this->render('home/create-user', $data);
        }
    }
}