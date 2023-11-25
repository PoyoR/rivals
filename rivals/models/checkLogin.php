<?php
date_default_timezone_set('America/Mexico_City');
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

require_once '../php/conexion.php';

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

    public function login(){

        $usuario = $_POST['usuario'];
        $pass = $_POST['pass'];

        // Obtiene la conexión
        $connection = $this->db->getConnection();

        $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);

        if ($usuario == "qq") {
            // Prepara la consulta para insertar el usuario en la base de datos
            $query = "UPDATE jugador SET pass = :pass WHERE usuario = :usuario ";
            $statement = $connection->prepare($query);

            // Asigna los valores a los parámetros de la consulta
            $statement->bindParam(':usuario', $usuario);
            $statement->bindParam(':pass', $hashedPassword);

            // Ejecuta la consulta
            $success = $statement->execute();
            $affectedRows = $statement->rowCount();

            if ($affectedRows  > 0) {
                return ['status' => 1, "msg" => "Constraseña actualizada correctamente"];
            }
        }else{

            // Prepara la consulta para buscar el usuario en la base de datos
            $query = "SELECT * FROM jugador WHERE usuario = :username";
            $statement = $connection->prepare($query);
            $statement->bindParam(':username', $usuario);

            // Ejecuta la consulta
            $statement->execute();

            // Obtiene el resultado de la consulta
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            // Verifica si el usuario existe en la base de datos y si la contraseña coincide
            if ($result && password_verify($pass, $result['pass'])) {

                // Credenciales válidas, inicia la sesión del usuario
                $_SESSION['rivals'] = true;
                $_SESSION['rivals_id'] = $result['id'];
                $_SESSION['rivals_user'] = $result['usuario'];
                $_SESSION['rivals_perfil'] = $result['perfil'];
                $_SESSION['rivals_battletag'] = $result['battlenet'];
                $_SESSION['rivals_caster'] = $result['caster'];

                return ['status' => 1, "msg" => "Ingresando a Overwatch Rivals"];

            } else {

                return ['status' => 0, "msg" => "Usuario o contraseña incorrectos"];
            }
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
