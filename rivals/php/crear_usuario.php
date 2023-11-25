<?php
// Importa la clase DatabaseConnection
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtén los datos del formulario (cambiar 'nombre_del_formulario' por el nombre adecuado)
    
    $username = $_POST['username'];    
    $rawPassword = $_POST['password'];

    $team = 1;
    $perfil = "";
    $battlenet = "Poyo#11935";
    $twitch = "";
    $twitter = "";

    // Encripta la contraseña usando password_hash() con el algoritmo BCRYPT
    $hashedPassword = password_hash($rawPassword, PASSWORD_BCRYPT);

    try {
        // Crea un objeto de DatabaseConnection
        $db = new DatabaseConnection();

        // Obtiene la conexión
        $connection = $db->getConnection();

        // Prepara la consulta para insertar el usuario en la base de datos
        $query = "INSERT INTO jugador (usuario, pass, equipo, perfil, battlenet, twitch, twitter) VALUES (:username, :pass, :equipo, :perfil, :battlenet, :twitch, :twitter)";
        $statement = $connection->prepare($query);

        // Asigna los valores a los parámetros de la consulta
        $statement->bindParam(':username', $username);
        $statement->bindParam(':pass', $hashedPassword);
        $statement->bindParam(':equipo', $team);
        $statement->bindParam(':perfil', $perfil);
        $statement->bindParam(':battlenet', $battlenet);
        $statement->bindParam(':twitch', $twitch);
        $statement->bindParam(':twitter', $twitter);

        // Ejecuta la consulta
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
