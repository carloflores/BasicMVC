<?php

class Database
{
    private $conn;

    public function connect()
    {

        $config = require __DIR__ . '/../config/database.php';
        $this->conn = null;

        try {
            $this->conn = new PDO(
                'mysql:host=' . $config['host'] . ';dbname=' . $config['db'] . ';charset=' . $config['charset'],
                $config['user'],
                $config['pass']
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
}