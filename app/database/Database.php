<?php

namespace App\Database;

use PDO;
use PDOException;

class Database
{
    private $host = '127.0.0.1';
    private $port = '3306';
    private $database = 'test_app';
    private $user = 'root';
    private $password = '';
    private PDO $PDO;

    public function __construct()
    {
        $this->connection();
    }

    public function connection()
    {
        try {
            $this->PDO = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->database", $this->user, $this->password);
            $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->PDO;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }

    public function getPDO(): PDO
    {
        return $this->PDO;
    }
}
