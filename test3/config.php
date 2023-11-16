<?php
class Database {
    private $host = "localhost";
    private $db_name = "userproject";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection(){
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
            return $this->conn;
        } catch(PDOException $e) {
            echo "Databaseverbinding mislukt: " . $e->getMessage();
        }
    }
}
