<?php

namespace App\Repositories;

use App\Database\Database;
use App\Models\User;
use App\Views\View;
use PDO;

class UserRepository
{
    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = (new Database())->getPDO();
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute();
        $users = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = new User($row['id'], $row['name'], $row['email'], $row['password']);
        }
        return $users;
    }

    public function createUser(User $user)
    {
        $sql = "INSERT INTO users (name, email, password, created_at) VALUES (:name, :email, :password, :created_at)";
        $stmt = $this->PDO->prepare($sql);
        try {
            $stmt->execute([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'created_at' => $user->getCreatedAt()
            ]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (\PDOException $e) {
            View::error($e);
        }
    }

    public function deleteUser($id)
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);
        return null;
    }

    public function getByEmail(string $email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function getByName(string $name)
    {
        $sql = "SELECT * FROM users WHERE name = :name";
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute(['name' => $name]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
}