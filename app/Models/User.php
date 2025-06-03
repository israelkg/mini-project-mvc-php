<?php

namespace App\Models;

class User
{
    //simu de db
    private array $users = [
        ['id' => 1, 'name' => 'Alice Silva', 'email' => 'alice@example.com', 'role' => 'admin'],
        ['id' => 2, 'name' => 'Bruno Costa', 'email' => 'bruno@example.com', 'role' => 'user'],
        ['id' => 3, 'name' => 'Carla Dias', 'email' => 'carla@example.com', 'role' => 'editor'],
        ['id' => 4, 'name' => 'Daniel Souza', 'email' => 'daniel@example.com', 'role' => 'user'],
    ];

    /**
     * retorna todos os usuários
     * @return array
     */
    public function getAllUsers(): array{
        return $this->users;
    }

    /**
     * @param int $id
     * @return array|null 
     */
    public function getUserById(int $id): ?array{
        foreach ($this->users as $user) {
            if ($user['id'] === $id) {
                return $user;
            }
        }
        return null;
    }

    /**
     * @param array $userData date new user (name, email).
     * @return array 
     */
    public function addUser(array $userData): array{
        $newId = end($this->users)['id'] + 1; 
        $newUser = [
            'id' => $newId,
            'name' => $userData['name'] ?? 'Novo Usuário',
            'email' => $userData['email'] ?? 'email@example.com',
            'role' => $userData['role'] ?? 'user'
        ];
        $this->users[] = $newUser;
        return $newUser;
    }
}