<?php

namespace App\Models;

class User extends Model
{
    private string $tableName = 'users';
    private string $name;
    private string $email;
    private string $password;
    private mixed $createdAt;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return password_verify($this->password, PASSWORD_BCRYPT);
    }

    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function getCreatedAt(): mixed
    {
        return $this->createdAt;
    }

    public function setCreatedAt(mixed $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function save()
    {
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'created_at' => $this->createdAt
        ];

        return $this->create($this->tableName, $data);
    }

    public function findById($id, array $columns = [])
    {
        if (empty($columns)) {
            $tableColumn = '*';
        } else {
            $tableColumn = implode(',', $columns);
        }
        $query = "SELECT $tableColumn FROM {$this->tableName} WHERE id = :id";
        $params = ['id' => $id];

        return $this->read($query, $params);
    }

    public function findByName(string $name)
    {

        $query = "SELECT * FROM {$this->tableName} WHERE name = :name";
        $params = ['name' => $name];

        return $this->read($query, $params)[0];
    }

    public function updateRecord($id)
    {
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'created_at' => $this->createdAt
        ];

        $where = "id = :id";
        $data['id'] = $id;

        return $this->update($this->tableName, $data, $where);
    }

    public function deleteRecord($id)
    {
        $where = "id = :id";
        $params = ['id' => $id];

        return $this->delete($this->tableName, $where, $params);
    }

    public function findByColumns(array $columns)
    {
        $params = implode(',', $columns);
        $query = "SELECT $params FROM {$this->tableName}";
        return $this->read($query);
    }

    public function findByEmail(string $email)
    {
        $query = "SELECT * FROM {$this->tableName} WHERE email = :email";
        $params = ['email' => $email];

        return $this->read($query, $params);
    }
}
