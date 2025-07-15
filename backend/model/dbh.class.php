<?php

class Dbh {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "msme_db";

    protected function connect() {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->database;charset=utf8mb4";
            $pdo = new PDO($dsn, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
}