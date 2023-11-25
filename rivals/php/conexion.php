<?php

class DatabaseConnection {
    
    private $host = 'localhost';
    private $username = 'u806919209_poyo'; // Reemplaza 'tu_usuario' con el nombre de usuario de tu base de datos
    private $password = 'Poyo-Rivera99'; // Reemplaza 'tu_contraseña' con la contraseña de tu base de datos
    private $dbname = 'u806919209_rivals'; // Reemplaza 'nombre_base_de_datos' con el nombre de tu base de datos

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