<?php

namespace App\Models;

use App\Database\Database;
use PDO;

class Model
{
    protected PDO $dbConn;

    public function __construct()
    {
        $this->dbConn = (new Database())->getPDO();
    }

    public function create(string $table, array $data)
    {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_map(fn($key) => ":$key", array_keys($data)));
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";

        try {
            $stmt = $this->dbConn->prepare($sql);
            $stmt->execute($data);
            return $this->dbConn->lastInsertId();
        } catch (\PDOException $e) {
            echo "Create failed: " . $e->getMessage();
            return false;
        }
    }

    public function read(string $query, array $params = [])
    {
        try {
            $stmt = $this->dbConn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo "Read failed: " . $e->getMessage();
            return false;
        }
    }

    public function update(string $table, array $data, string $where)
    {
        $set = implode(", ", array_map(fn($key) => "$key = :$key", array_keys($data)));
        $sql = "UPDATE $table SET $set WHERE $where";

        try {
            $stmt = $this->dbConn->prepare($sql);
            return $stmt->execute($data);
        } catch (\PDOException $e) {
            echo "Update failed: " . $e->getMessage();
            return false;
        }
    }

    public function delete(string $table, string $where, array $params)
    {
        $sql = "DELETE FROM $table WHERE $where";

        try {
            $stmt = $this->dbConn->prepare($sql);
            return $stmt->execute($params);
        } catch (\PDOException $e) {
            echo "Delete failed: " . $e->getMessage();
            return false;
        }
    }
}
