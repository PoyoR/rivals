<?php
// Importa la clase DatabaseConnection
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    
    $username = $_POST['username'];    
    $rawPassword = $_POST['password'];

    $team = 1;
    $perfil = "";
    $battlenet = "Poyo#11935";
    $twitch = "";
    $twitter = "";

    
    $hashedPassword = password_hash($rawPassword, PASSWORD_BCRYPT);

    try {
        
        $db = new DatabaseConnection();

        
        $connection = $db->getConnection();

        
        $query = "INSERT INTO jugador (usuario, pass, equipo, perfil, battlenet, twitch, twitter) VALUES (:username, :pass, :equipo, :perfil, :battlenet, :twitch, :twitter)";
        $statement = $connection->prepare($query);

        
        $statement->bindParam(':username', $username);
        $statement->bindParam(':pass', $hashedPassword);
        $statement->bindParam(':equipo', $team);
        $statement->bindParam(':perfil', $perfil);
        $statement->bindParam(':battlenet', $battlenet);
        $statement->bindParam(':twitch', $twitch);
        $statement->bindParam(':twitter', $twitter);

        
        $statement->execute();

        echo "Usuario creado exitosamente.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Crear Usuario</title>
</head>
<body>
    <h1>Crear Usuario</h1>
    <form action="crear_usuario.php" method="post">
        <label for="username">Nombre de usuario:</label>
        <input type="text" name="username" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" value="Crear Usuario">
    </form>
</body>
</html>
