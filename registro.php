<?php
date_default_timezone_set('America/Mexico_City');
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'rivals/php/conexion.php';

class Funciones
{
    private static $instancia = null;
    // Crea un objeto de DatabaseConnection
    private $db = null;

    public function __construct()
    {
        $this->db = new DatabaseConnection();
    }

    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $clase = __CLASS__;
            self::$instancia = new $clase;
        }
        return self::$instancia;
    }

    public static function cleanTxt($cadena){
        return htmlentities(trim($cadena));
    }

    public function registro(){

        $usuario = $_POST['usuario'];

        // Obtiene la conexión
        $connection = $this->db->getConnection();

        if ($this->isUsernameAvailable($usuario) == 1) {
            return ["status" => 0, "msg" => "Nombre de usuario no disponible, por favor elige otro"];
        } 

        $pass = $_POST['pass'];
        $bt = $_POST['bt'];

        //Validar bt
        $query = "SELECT id FROM jugador WHERE battlenet = :bt";
        $statement = $connection->prepare($query);
        $statement->bindParam(':bt', $bt);
        $result = $statement->execute();
        $affectedRows = $statement->rowCount();
 
         if($affectedRows > 0){
            return ['status' => 0, 'msg' => "Este BT ya se encuentra vinculado a otro usuario"];
         }


        

        $team = "";
        $perfil = "assets/images/perfil/soldado.jpg";
        $twitch = "";
        $twitter = "";
        $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);


        // Prepara la consulta para insertar el usuario en la base de datos
        $query = "INSERT INTO jugador (usuario, pass, perfil, battlenet, twitch, twitter) VALUES (:username, :pass, :perfil, :battlenet, :twitch, :twitter)";
        $statement = $connection->prepare($query);

        // Asigna los valores a los parámetros de la consulta
        $statement->bindParam(':username', $usuario);
        $statement->bindParam(':pass', $hashedPassword);
        $statement->bindParam(':perfil', $perfil);
        $statement->bindParam(':battlenet', $bt);
        $statement->bindParam(':twitch', $twitch);
        $statement->bindParam(':twitter', $twitter);

        // Ejecuta la consulta
        $success = $statement->execute();
        $affectedRows = $statement->rowCount();

        if ($success) {
            
            return ['status' => 1, "Registro exitoso", "rows" => $affectedRows];
        } else {
            
            return ['status' => 0, "Ocurrió un error al registrarse, por favor reintenta", "rows" => $affectedRows];
        }

    }

    private function isUsernameAvailable($username) {
        try {
            // Obtiene la conexión
            $connection = $this->db->getConnection();
            // Prepara la consulta para buscar el nombre de usuario en la base de datos
            $query = "SELECT usuario FROM jugador WHERE usuario = :username";
            $statement = $connection->prepare($query);
    
            // Asigna el valor del parámetro de consulta
            $statement->bindParam(':username', $username);
    
            // Ejecuta la consulta
            $statement->execute();
    
            // Obtiene el resultado de la consulta
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $affectedRows = $statement->rowCount();
    
            // Si el resultado es 0, el nombre de usuario no existe y está disponible
            return $affectedRows;
        } catch (PDOException $e) {
            // Manejo de error en caso de que ocurra una excepción
            echo "Error: " . $e->getMessage();
            return false; // Retorna falso en caso de error
        }
    }

} //endClass

#Evita exepciones en peticiones sin funcion
$Funciones = Funciones::getInstancia();
$method = Funciones::cleanTxt($_POST['function']);

if (method_exists($Funciones, $method)) {
    $data = $Funciones->$method();
    echo json_encode($data);
} else {
    echo json_encode(['status' => 0, 'msg' => 'Método no existente']);
    http_response_code(409);
}
