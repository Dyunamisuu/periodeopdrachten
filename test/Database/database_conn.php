<?php

class Database
{
    private $host = "localhost";
    private $db_name = "webwinkeltest";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Databaseverbinding mislukt: " . $exception->getMessage();
        }

        return $this->conn;
    }

    public function prepare($query)
    {
        return $this->conn->prepare($query);
    }
}