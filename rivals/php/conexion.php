<?php

class DatabaseConnection {
    
    private $host = 'localhost';
    private $username = 'xx'; 
    private $password = 'xx'; 
    private $dbname = 'xx'; 

    private $connection;

    public function __construct() {
        try {
            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error al conectar a la base de datos: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->connection;
    }
}
?>
