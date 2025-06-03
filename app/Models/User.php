<?php

namespace App\Models;

//em sistemas maiores, poderia haver uma 'BaseModel' para lógica comum de banco de dados.

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
     * encontra um usuário pelo ID..
     * @param int $id
     * @return array|null retorna o array do usuário ou null se não for encontrado.
     */
    public function getUserById(int $id): ?array
    {
        foreach ($this->users as $user) {
            if ($user['id'] === $id) {
                return $user;
            }
        }
        return null; // usuário não encontrado
    }

    /**
     * a adição de um novo usuário.
     * @param array $userData date new user (name, email).
     * @return array user add with a ID (simulado).
     */
    public function addUser(array $userData): array
    {
        $newId = end($this->users)['id'] + 1; // ID para simu
        $newUser = [
            'id' => $newId,
            'name' => $userData['name'] ?? 'Novo Usuário',
            'email' => $userData['email'] ?? 'email@example.com',
            'role' => $userData['role'] ?? 'user'
        ];
        $this->users[] = $newUser; // add array
        return $newUser;
    }
}