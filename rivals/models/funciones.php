<?php
date_default_timezone_set('America/Mexico_City');
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

require_once '../php/conexion.php';

class Funciones
{
    private static $instancia = null;
    private $user = "";
    private $idUser = "";

    // Crea un objeto de DatabaseConnection
    private $db = null;

    public function __construct()
    {
        $this->db = new DatabaseConnection();
        $this->user   = $_SESSION['rivals_user'];
        $this->idUser   = $_SESSION['rivals_id'];
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

    public function getInfoTorneo(){

        $torneo = $_POST['torneo'];
        // Obtiene la conexión
        $connection = $this->db->getConnection();

        $query = "SELECT * FROM torneo WHERE id = :idTorneo ";
        $statement = $connection->prepare($query);

        $statement->bindParam(':idTorneo', $torneo);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        if($affectedRows > 0){
            return ['status' => 1, 'data' => $result];
        }else{
            return ['status' => 0];
        }


    }

    public function editarEquipo(){

        $nombreEquipo = $_POST['nombre'];
        $twEquipo = $_POST['tw'];
        $fbEquipo = $_POST['fb'];
        $igEquipo = $_POST['ig'];
        $tkEquipo = $_POST['tk'];
        $dcEquipo = $_POST['dc'];
        $idEquipo = $_POST['idEquipo'];
        $plataformaEquipo = $_POST['plataforma'];
        
        // Obtiene la conexión
        $connection = $this->db->getConnection();

        $query = "SELECT creador FROM equipo WHERE id = :idEquipo AND creador = :user";
        $statement = $connection->prepare($query);

        // Asigna el valor del parámetro de consulta
        //$statement->bindParam(':creador', $this->user);
        $statement->bindParam(':idEquipo', $idEquipo);
        $statement->bindParam(':user', $this->user);

        // Ejecuta la consulta
        $statement->execute();

        // Obtiene el resultado de la consulta
        $affectedRows = $statement->rowCount();

        if($affectedRows == 0){
            return ['status' => 0, "msg" => "No tienes privilegios para realizar esta acción"];
        }
        
        if (isset($_FILES["image"])) {
            $file = $_FILES["image"];
            $fileName = $file["name"];
            $fileTmpName = $file["tmp_name"];
            $fileError = $file["error"];

            


            // Verifica si no hubo errores en la subida del archivo
            if ($fileError === UPLOAD_ERR_OK) {
                // Verifica el tipo de archivo (solo imágenes permitidas)
                $allowedTypes = array("image/jpeg", "image/png", "image/gif");
                if (!in_array($file["type"], $allowedTypes)) {

                    return ['status' => 0, "msg" => "Error: Solo se permiten imágenes en formato JPG, PNG o GIF"];
                }

                // Verifica el tamaño del archivo (máximo 2 MB)
                $maxFileSize = 2 * 1024 * 1024; // 2 MB en bytes
                if ($file["size"] > $maxFileSize) {

                    return ['status' => 0, "msg" => "Error: El tamaño del archivo es demasiado grande (máximo 2 MB)"];
                }

                // Obtiene la extensión del archivo original
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

                // Sanitiza el nombre del archivo para evitar posibles ataques maliciosos
                $safeFileName = preg_replace('/[^a-zA-Z0-9_-]/', '', $fileName);

                 // Crea un nuevo nombre para el archivo con la extensión original
                $targetFileName = $safeFileName . '.' . $fileExtension;

                // Directorio donde se guardará la imagen (cambia la ruta a tu ubicación deseada)
                $targetDirectory = "../assets/logos/";
                $targetFile = $targetDirectory . $targetFileName;

                // Mueve el archivo temporal a su ubicación final
                if (move_uploaded_file($fileTmpName, $targetFile)) {

                    // Prepara la consulta para actualizar
                    $query = "UPDATE equipo SET nombre=:nombre, logo=:logo, twitter=:twitter, facebook=:facebook, instagram=:instagram, tiktok=:tiktok, discord=:discord, plataforma=:plataforma WHERE id=:idEquipo";
                    $statement = $connection->prepare($query);

                    // Asigna los valores a los parámetros de la consulta
                    $statement->bindParam(':idEquipo', $idEquipo); // Assuming $idEquipo is defined elsewhere
                    $statement->bindParam(':nombre', $nombreEquipo);
                    $statement->bindParam(':logo', $targetFile);
                    $statement->bindParam(':twitter', $twEquipo);
                    $statement->bindParam(':facebook', $fbEquipo);
                    $statement->bindParam(':instagram', $igEquipo);
                    $statement->bindParam(':tiktok', $tkEquipo);
                    $statement->bindParam(':discord', $dcEquipo);
                    $statement->bindParam(':plataforma', $plataformaEquipo);

                    // Ejecuta la consulta
                    $success = $statement->execute();
                    $affectedRows = $statement->rowCount();

                    if ($success) {
                        
                        return ['status' => 1, "msg" => "Datos actualizados correctamente", "rows" => $affectedRows];
                    } else {
                        
                        return ['status' => 0, "msg" => "Ocurrió un error al actualizar los datos, por favor reintente", "rows" => $affectedRows];
                    }

                } else {

                    return ['status' => 0, "msg" => "Error al subir la imagen, por favor reintente"];
                }
            } else {

                return ['status' => 0, "msg" => "Error en la subida de la imagen, por favor reintente"];
            }
        } else {

            // Prepara la consulta para actualizar
            $query = "UPDATE equipo SET nombre=:nombre, twitter=:twitter, facebook=:facebook, instagram=:instagram, tiktok=:tiktok, discord=:discord, plataforma=:plataforma WHERE id=:idEquipo";
            $statement = $connection->prepare($query);

            // Asigna los valores a los parámetros de la consulta
            $statement->bindParam(':idEquipo', $idEquipo); // Assuming $idEquipo is defined elsewhere
            $statement->bindParam(':nombre', $nombreEquipo);
            $statement->bindParam(':twitter', $twEquipo);
            $statement->bindParam(':facebook', $fbEquipo);
            $statement->bindParam(':instagram', $igEquipo);
            $statement->bindParam(':tiktok', $tkEquipo);
            $statement->bindParam(':discord', $dcEquipo);
            $statement->bindParam(':plataforma', $plataformaEquipo);

            // Ejecuta la consulta
            $result = $statement->execute();
            $affectedRows = $statement->rowCount();

            if ($result) {
                $affectedRows = $statement->rowCount();
                if ($affectedRows > 0) {
                    return ['status' => 1, 'msg' => "Datos actualizados correctamente"];
                } else {
                    if($statement->errorInfo()[2] == null){
                        return ['status' => 0, 'msg' => "No hay cambios que guardar"];
                    }else{
                        return ['status' => 0, 'msg' => "No se realizaron cambios en los datos"];
                    }
                    
                }
            } else {
                $errorInfo = $statement->errorInfo();
                return ['status' => 0, 'msg' => "Ocurrió un error al actualizar tus datos", "error" => $errorInfo];
            }

            //return ['status' => 0, "msg" => "No se seleccionó ninguna imagen"];
        }
    }

    public function registrarEquipo(){

        // Obtiene la conexión
        $connection = $this->db->getConnection();
        
        if (isset($_FILES["image"])) {
            $file = $_FILES["image"];
            $fileName = $file["name"];
            $fileTmpName = $file["tmp_name"];
            $fileError = $file["error"];

            $nombreEquipo = $_POST['nombre'];
            $twEquipo = $_POST['tw'];
            $fbEquipo = $_POST['fb'];
            $igEquipo = $_POST['ig'];
            $tkEquipo = $_POST['tk'];
            $dcEquipo = $_POST['dc'];
            $plataformaEquipo = $_POST['plataforma'];


            // Verifica si no hubo errores en la subida del archivo
            if ($fileError === UPLOAD_ERR_OK) {
                // Verifica el tipo de archivo (solo imágenes permitidas)
                $allowedTypes = array("image/jpeg", "image/png", "image/gif");
                if (!in_array($file["type"], $allowedTypes)) {

                    return ['status' => 0, "msg" => "Error: Solo se permiten imágenes en formato JPG, PNG o GIF"];
                }

                // Verifica el tamaño del archivo (máximo 2 MB)
                $maxFileSize = 2 * 1024 * 1024; // 2 MB en bytes
                if ($file["size"] > $maxFileSize) {

                    return ['status' => 0, "msg" => "Error: El tamaño del archivo es demasiado grande (máximo 2 MB)"];
                }

                // Obtiene la extensión del archivo original
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

                // Sanitiza el nombre del archivo para evitar posibles ataques maliciosos
                $safeFileName = preg_replace('/[^a-zA-Z0-9_-]/', '', $fileName);

                 // Crea un nuevo nombre para el archivo con la extensión original
                $targetFileName = $safeFileName . '.' . $fileExtension;

                // Directorio donde se guardará la imagen (cambia la ruta a tu ubicación deseada)
                $targetDirectory = "../assets/logos/";
                $targetFile = $targetDirectory . $targetFileName;

                // Mueve el archivo temporal a su ubicación final
                if (move_uploaded_file($fileTmpName, $targetFile)) {

                    // Prepara la consulta para insertar
                    $query = "INSERT INTO equipo (nombre, logo, twitter, facebook, instagram, tiktok, discord, plataforma, creador) VALUES (:nombre, :logo, :twitter, :facebook, :instagram, :tiktok, :discord, :plataforma, :owner)";
                    $statement = $connection->prepare($query);

                    // Asigna los valores a los parámetros de la consulta
                    $statement->bindParam(':owner', $this->user);
                    $statement->bindParam(':nombre', $nombreEquipo);
                    $statement->bindParam(':logo', $targetFile);
                    $statement->bindParam(':twitter', $twEquipo);
                    $statement->bindParam(':facebook', $fbEquipo);
                    $statement->bindParam(':instagram', $igEquipo);
                    $statement->bindParam(':tiktok', $tkEquipo);
                    $statement->bindParam(':discord', $dcEquipo);
                    $statement->bindParam(':plataforma', $plataformaEquipo);

                    // Ejecuta la consulta
                    $success = $statement->execute();

                    // Obtiene el último ID insertado
                    $lastInsertedId = $connection->lastInsertId();

                    $affectedRows = $statement->rowCount();

                    if ($success) {

                        $query = "INSERT INTO equipo_jugador (id_jugador, id_equipo) VALUES (:idJ, :idE)";
                        $statement = $connection->prepare($query);

                        // Asigna los valores a los parámetros de la consulta
                        $statement->bindParam(':idJ', $this->idUser);
                        $statement->bindParam(':idE', $lastInsertedId);

                        // Ejecuta la consulta
                        $statement->execute();
                        
                        return ['status' => 1, "msg" => "Equipo creado exitosamente", "rows" => $affectedRows];
                    } else {
                        
                        return ['status' => 0, "msg" => "Ocurrió un error al registrarse, por favor reintenta", "rows" => $affectedRows];
                    }

                } else {

                    return ['status' => 0, "msg" => "Error al subir la imagen, por favor reintente"];
                }
            } else {

                return ['status' => 0, "msg" => "Error en la subida de la imagen, por favor reintente"];
            }
        } else {

            return ['status' => 0, "msg" => "No se seleccionó ninguna imagen"];
        }
        

    }

    public function getequiposOwner(){

        $torneo = $_POST['torneo'];

        // Obtiene la conexión
        $connection = $this->db->getConnection();

        //Get plataforma torneo
        $query = "SELECT plataforma FROM torneo WHERE id = :torneo";
        $statement = $connection->prepare($query);
        $statement->bindParam(':torneo', $torneo);
        $statement->execute();
        $plataforma = $statement->fetch(PDO::FETCH_COLUMN);
        $affectedRows = $statement->rowCount();
        
        if($affectedRows == 0){
            return ['status' => 0, "msg" => "No se encontró información del torneo"];
        }

        $query = "SELECT equipo FROM torneo_equipo WHERE torneo = :torneo";
        $statement = $connection->prepare($query);
        $statement->bindParam(':torneo', $torneo);
        $statement->execute();
        $equipos = $statement->fetchAll(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        if($affectedRows > 0){

            $inscritosArray = array();
            foreach($equipos as $item){
                $inscritosArray[] = $item['equipo']; 
            }

            $inscritosArray = implode("','", $inscritosArray);

            /*if($plataforma == "pc"){
                $query = "SELECT * FROM equipo WHERE creador = :user AND (plataforma = :platform OR plataforma = 'hibrido') AND id NOT IN ('$inscritosArray') ";
            }else{
                $query = "SELECT * FROM equipo WHERE creador = :user AND plataforma = :platform AND id NOT IN ('$inscritosArray') ";
            } */
            //$query = "SELECT * FROM equipo WHERE creador = :user AND (plataforma = :platform OR plataforma = 'hibrido') AND id NOT IN ('$inscritosArray') ";      
            $query = "SELECT * FROM equipo WHERE creador = :user AND id NOT IN ('$inscritosArray') ";      
            
            $statement = $connection->prepare($query);
            $statement->bindParam(':user', $this->user);
            //$statement->bindParam(':platform', $plataforma);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $affectedRows = $statement->rowCount();

            if($affectedRows > 0){
                return ['status' => 1, 'data' => $result, 'equipos' => $inscritosArray];
            }else{
                return ['status' => 2];
            }

            
        }else{
            // Prepara la consulta para buscar el nombre de usuario en la base de datos
            $query = "SELECT * FROM equipo WHERE creador = :user AND (plataforma = :platform OR plataforma = 'hibrido')";
            $statement = $connection->prepare($query);

            // Asigna el valor del parámetro de consulta
            $statement->bindParam(':user', $this->user);
            $statement->bindParam(':platform', $plataforma);

            // Ejecuta la consulta
            $statement->execute();

            // Obtiene el resultado de la consulta
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $affectedRows = $statement->rowCount();

            if($affectedRows > 0){
                return ['status' => 1, 'data' => $result];
            }else{
                return ['status' => 2];
            }
        }


        

    }


    public function getequipos(){

        // Obtiene la conexión
        $connection = $this->db->getConnection();
        // Prepara la consulta para buscar el nombre de usuario en la base de datos
        $query = "SELECT e.*, if(e.creador=:user, 1, 0) as admin FROM equipo_jugador ej LEFT JOIN equipo e ON e.id=ej.id_equipo WHERE ej.id_jugador = :jugador";
        $statement = $connection->prepare($query);

        // Asigna el valor del parámetro de consulta
        //$statement->bindParam(':creador', $this->user);
        $statement->bindParam(':jugador', $this->idUser);
        $statement->bindParam(':user', $this->user);

        // Ejecuta la consulta
        $statement->execute();

        // Obtiene el resultado de la consulta
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        if($affectedRows > 0){
            return ['status' => 1, 'data' => $result];
        }else{
            return ['status' => 0];
        }

    }

    public function getTorneos(){

        // Obtiene la conexión
        $connection = $this->db->getConnection();
        // Prepara la consulta para buscar el nombre de usuario en la base de datos
        $query = "SELECT * FROM torneo";
        $statement = $connection->prepare($query);

        // Ejecuta la consulta
        $statement->execute();

        // Obtiene el resultado de la consulta
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        if($affectedRows > 0){
            return ['status' => 1, 'data' => $result];
        }else{
            return ['status' => 0];
        }

    }

    /*public function getSiguienteMatch(){
        

        $fechaActual = date('Y-m-d');

        $connection = $this->db->getConnection();
        
        $query = "SELECT e.id, e.nombre, e.logo FROM equipo_jugador ej LEFT JOIN equipo e ON e.id=ej.id_equipo WHERE ej.id_jugador = :jugador";
        $statement = $connection->prepare($query);

        $statement->bindParam(':jugador', $this->idUser);

        // Ejecuta la consulta
        $statement->execute();

        // Obtiene el resultado de la consulta
        $equipos = $statement->fetchAll(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        $arrayTorneos = array();
        $arrayMatches = array();
        $equipoMatch = "";
        $equipoMatch2 = "";

        if($affectedRows > 0){

            $cont = 0;
            foreach($equipos as $equipo){
                $query = "SELECT t.id, t.nombre, t.plataforma FROM torneo t LEFt JOIN torneo_equipo te ON te.torneo=t.id WHERE te.equipo = :idEquipo";
                $statement = $connection->prepare($query);
                $statement->bindParam(':idEquipo', $equipo['id']);                 
                $statement->execute();
                $torneos = $statement->fetch(PDO::FETCH_ASSOC);
                $affectedRows = $statement->rowCount();

                if($affectedRows > 0){
                    $arrayTorneos[] = $torneos;

                    foreach($torneos as $torneo){
                        $query = "SELECT j.numero, j.fecha, j.hora, e.equipo1, e.equipo2 FROM jornada j LEFT JOIN encuentro e ON e.jornada=j.id WHERE (e.equipo1 = :miEquipo OR e.equipo2 = :miEquipo) 
                        AND j.torneo = :torneo_id AND j.fecha > :fecha LIMIT 1";
                    
                        $statement = $connection->prepare($query);
                        $statement->bindParam(':torneo_id', $torneos['id']);
                        $statement->bindParam(':fecha', $fechaActual);
                        $statement->bindParam(':miEquipo', $equipo['id']);
                        $statement->execute();
                        $match = $statement->fetch(PDO::FETCH_ASSOC);
                        $affectedRowsMatches = $statement->rowCount();

                        if($affectedRowsMatches > 0){

                            $equipo1 = $match['equipo1'];
                            $equipo2 = $match['equipo2'];

                            $arrayMatches[] = $match;

                            $queryEquipo = "SELECT id, nombre, logo FROM equipo WHERE id = :idEquipo1 OR id = :idEquipo2 ";
                            $statement = $connection->prepare($queryEquipo);
                            $statement->bindParam(':idEquipo1', $equipo1);
                            $statement->bindParam(':idEquipo2', $equipo2);
                            $statement->execute();
                            $equipoMatch = $statement->fetch(PDO::FETCH_ASSOC);
                            $affectedRowsEquiposMatches = $statement->rowCount();

                            $queryEquipo2 = "SELECT id, nombre, logo FROM equipo WHERE id = :idEquipo1 OR id = :idEquipo2 ";
                            $statement = $connection->prepare($queryEquipo2);
                            $statement->bindParam(':idEquipo1', $equipo['id']);
                            $statement->bindParam(':idEquipo2', $equipo['id']);
                            $statement->execute();
                            $equipoMatch2 = $statement->fetch(PDO::FETCH_ASSOC);
                            $affectedRowsEquiposMatches2 = $statement->rowCount();

                        }

                    }
                }
                
                
            }

            return ['status' => 1, 'torneos' => $arrayTorneos, 'matches' => $arrayMatches, 'rival' => $equipoMatch, 'equipo' => $equipoMatch2];
        }else{
            return ['status' => 0];
        }


    }*/

    public function getSiguienteMatch(){

        $fechaActual = date('Y-m-d');

        $connection = $this->db->getConnection();
        
        $query = "SELECT e.id, e.nombre, e.logo FROM equipo_jugador ej LEFT JOIN equipo e ON e.id=ej.id_equipo WHERE ej.id_jugador = :jugador";
        $statement = $connection->prepare($query);

        $statement->bindParam(':jugador', $this->idUser);

        // Ejecuta la consulta
        $statement->execute();

        // Obtiene el resultado de la consulta
        $equipos = $statement->fetchAll(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        $arrayTorneos = array();
        $arrayMatches = array();
        $equipoMatch = "";
        $equipoMatch2 = "";

        if($affectedRows > 0){

            $cont = 0;
            foreach ($equipos as $equipo) {
                $query = "SELECT t.id, t.nombre, t.plataforma FROM torneo t 
                          LEFT JOIN torneo_equipo te ON te.torneo = t.id 
                          WHERE te.equipo = :idEquipo";
                $statement = $connection->prepare($query);
                $statement->bindParam(':idEquipo', $equipo['id']);                 
                $statement->execute();
                $torneo = $statement->fetch(PDO::FETCH_ASSOC);
            
                if ($torneo) {
                    $arrayTorneos[] = $torneo;
            
                    $query = "SELECT j.numero, e.fecha, e.hora, e.equipo1, e.equipo2,
                              IF(e.equipo1 = :miEquipo, 'Equipo', 'Rival') AS equipo1_tipo,
                              IF(e.equipo2 = :miEquipo, 'Equipo', 'Rival') AS equipo2_tipo
                              FROM jornada j 
                              LEFT JOIN encuentro e ON e.jornada = j.id 
                              WHERE (e.equipo1 = :miEquipo OR e.equipo2 = :miEquipo) 
                              AND j.torneo = :torneo_id AND e.fecha >= :fecha 
                              LIMIT 1";
                            
                    $statement_match = $connection->prepare($query);
                    $statement_match->bindParam(':torneo_id', $torneo['id']);
                    $statement_match->bindParam(':fecha', $fechaActual);
                    $statement_match->bindParam(':miEquipo', $equipo['id']);
                    $statement_match->execute();
                    $match = $statement_match->fetch(PDO::FETCH_ASSOC);
                    $affectedRowsMatches = $statement_match->rowCount();
                
                    if ($affectedRowsMatches > 0) {

                        $equipo1 = $match['equipo1'];
                        //Mi equipo
                        $queryEquipo = "SELECT id, nombre, logo FROM equipo WHERE id = :idEquipo ";
                        $statement = $connection->prepare($queryEquipo);
                        $statement->bindParam(':idEquipo', $equipo1);
                        $statement->execute();
                        $equipoMatch = $statement->fetch(PDO::FETCH_ASSOC);
                        $affectedRowsEquiposMatches = $statement->rowCount();

                        if($match['equipo1_tipo'] == "Equipo"){

                            $match['equipo_datos'] = $equipoMatch;
                        }else{

                            $match['rival_datos'] = $equipoMatch;
                        }

                        $equipo2 = $match['equipo2'];
                        //Mi equipo
                        $queryEquipo = "SELECT id, nombre, logo FROM equipo WHERE id = :idEquipo ";
                        $statement = $connection->prepare($queryEquipo);
                        $statement->bindParam(':idEquipo', $equipo2);

                        $statement->execute();
                        $equipoMatch = $statement->fetch(PDO::FETCH_ASSOC);
                        $affectedRowsEquiposMatches = $statement->rowCount();

                        if($match['equipo2_tipo'] == "Equipo"){

                            $match['equipo_datos'] = $equipoMatch;
                        }else{

                            $match['rival_datos'] = $equipoMatch;
                        }

                        $arrayMatches[] = $match;
                    }
                }
            }
            
            return ['status' => 1, 'torneos' => $arrayTorneos, 'matches' => $arrayMatches];
             
        }else{
            return ['status' => 0];
        }

    }

    public function castearMatch(){

        $matches = $_POST['match'];

        $match = explode("-", $matches);
        $encuentro1 = $match[0];
        $encuentro2 = $match[1];
        $encuentro3 = $match[2];
        $encuentro4 = $match[3];

        // Obtiene la conexión
        $connection = $this->db->getConnection();

        $query = "SELECT id FROM encuentro WHERE id IN ('$encuentro1', '$encuentro2', '$encuentro3', '$encuentro4') AND caster != 0";
        $statement = $connection->prepare($query);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        if($affectedRows > 0){
            return ['status' => 0, 'msg' => "Este match ya fue previamente seleccionado para castear, intenta con otro match", "sql" => $query];
        }

        // Prepara la consulta para buscar el nombre de usuario en la base de datos
        $query = "UPDATE encuentro SET caster = :caster WHERE id IN ('$encuentro1', '$encuentro2', '$encuentro3', '$encuentro4')";
        $statement = $connection->prepare($query);

        $statement->bindParam(':caster', $this->idUser);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        if($affectedRows > 0){

            //Obtener los dueños de ambos equipos
            $query = "SELECT j1.id as cap_equipo1, j2.id as cap_equipo2, eq1.nombre as equipo1_nom, eq2.nombre as equipo2_nom FROM encuentro e 
            LEFT JOIN equipo eq1 ON e.equipo1 = eq1.id  
            LEFT JOIN equipo eq2 ON e.equipo2 = eq2.id 
            LEFT JOIN jugador j1 ON j1.usuario= eq1.creador
            LEFT JOIN jugador j2 ON j2.usuario= eq2.creador
            WHERE e.id = :idEncuentro ";
            $statement = $connection->prepare($query);
            $statement->bindParam(':idEncuentro', $encuentro1);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);


            $jugador1 = $result['cap_equipo1'];
            $equipo1_nom = $result['equipo1_nom'];



            $jugador2 = $result['cap_equipo2'];
            $equipo2_nom = $result['equipo2_nom'];

            $titulo = "Match seleccionado para ser casteado";
            $mensaje = "Tu match vs $equipo2_nom ha sido seleccionado para ser casteado por $this->user";
            $mensaje2 = "Tu match vs $equipo1_nom ha sido seleccionado para ser casteado por $this->user";

            //Agregar notificacion
            $query = "INSERT INTO notificacion SET jugador = :jugador, mensaje = :mensaje, titulo = :titulo";
            $statement = $connection->prepare($query);
            $statement->bindParam(':jugador', $jugador1);
            $statement->bindParam(':mensaje', $mensaje);
            $statement->bindParam(':titulo', $titulo);
            $statement->execute();

             //Agregar notificacion
             $query = "INSERT INTO notificacion SET jugador = :jugador, mensaje = :mensaje, titulo = :titulo";
             $statement = $connection->prepare($query);
             $statement->bindParam(':jugador', $jugador2);
             $statement->bindParam(':mensaje', $mensaje2);
             $statement->bindParam(':titulo', $titulo);
             $statement->execute();


            return ['status' => 1, 'msg' => "Match seleccionado para castear correctamente"];
        }else{
            return ['status' => 0, 'msg' => "No se pudo seleccionar el match para castear, por favor reintenta"];
        }

    }

    public function eliminarNotif(){

        $id = $_POST['id'];

        $connection = $this->db->getConnection();
        $query = "DELETE FROM notificacion WHERE id = :id";
        
        $statement = $connection->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $affectedRows = $statement->rowCount();

        if($affectedRows > 0){

            return ['status' => 1];
        }else{
            return ['status' => 0];
        }
    }

    public function getPartidasTorneo(){

        $torneo = $_POST['torneo'];

        $connection = $this->db->getConnection();
        $query = "SELECT e.id, j.numero as jornada, j.id as jornada_id, j.fecha, j.hora, eq1.nombre as equipo1, eq2.nombre as equipo2, m.nombre as mapa FROM jornada j 
            JOIN encuentro e ON e.jornada=j.id
            JOIN equipo eq1 ON e.equipo1 = eq1.id
            JOIN equipo eq2 ON e.equipo2 = eq2.id
            JOIN mapa m ON e.mapa = m.id
            WHERE j.torneo= :torneo AND e.equipo1 != -1 AND e.equipo2 != -1 ";
        
        $statement = $connection->prepare($query);
        $statement->bindParam(':torneo', $torneo);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        if($affectedRows > 0){

            return ['status' => 1, 'data' => $result];
        }else{
            return ['status' => 0];
        }

    }

    public function getTorneosActivos(){

        // Obtiene la conexión
        $connection = $this->db->getConnection();
        // Prepara la consulta para buscar el nombre de usuario en la base de datos
        $query = "SELECT * FROM torneo WHERE activo=1";
        $statement = $connection->prepare($query);

        // Ejecuta la consulta
        $statement->execute();

        // Obtiene el resultado de la consulta
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        if($affectedRows > 0){
            return ['status' => 1, 'data' => $result];
        }else{
            return ['status' => 0];
        }

    }

    public function getJugadores(){

        // Obtiene la conexión
        $connection = $this->db->getConnection();
        // Prepara la consulta para buscar el nombre de usuario en la base de datos
        $query = "SELECT id, usuario, battlenet FROM jugador";
        $statement = $connection->prepare($query);

        // Ejecuta la consulta
        $statement->execute();

        // Obtiene el resultado de la consulta
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        if($affectedRows > 0){
            return ['status' => 1, 'data' => $result];
        }else{
            return ['status' => 0];
        }

    }

    public function switchJornada(){

        $tipo = $_POST['tipo'];
        $jornada = $_POST['jornada'];

        $connection = $this->db->getConnection();
        $query = "UPDATE encuentro SET reportar = :tipo WHERE jornada = :jornada";
        $statement = $connection->prepare($query);
        $statement->bindParam(':tipo', $tipo);
        $statement->bindParam(':jornada', $jornada);

        $statement->execute();
        $affectedRows = $statement->rowCount();

        if($affectedRows > 0){
            return ['status' => 1, 'msg' => "Correcto"];
        }else{
            return ['status' => 0, 'msg' => "Ocurrió un error, por favor reintenta"];
        }
    }

    public function getJornadas(){

        // Obtiene la conexión
        $connection = $this->db->getConnection();
        // Prepara la consulta para buscar el nombre de usuario en la base de datos
        $query = "SELECT id, fecha, torneo, numero FROM jornada";
        $statement = $connection->prepare($query);

        // Ejecuta la consulta
        $statement->execute();

        // Obtiene el resultado de la consulta
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        if($affectedRows > 0){
            return ['status' => 1, 'data' => $result];
        }else{
            return ['status' => 0];
        }

    }

    public function getAllEquipos(){

        // Obtiene la conexión
        $connection = $this->db->getConnection();
        // Prepara la consulta para buscar el nombre de usuario en la base de datos
        $query = "SELECT id, nombre, plataforma FROM equipo";
        $statement = $connection->prepare($query);

        // Ejecuta la consulta
        $statement->execute();

        // Obtiene el resultado de la consulta
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        if($affectedRows > 0){
            return ['status' => 1, 'data' => $result];
        }else{
            return ['status' => 0];
        }

    }

    public function updtPerfil(){

        $tw = $_POST['tw'];
        $bt = $_POST['bt'];
        $ttv = $_POST['ttv'];
        $img = $_POST['img'];

        $connection = $this->db->getConnection();

        //Validar bt
        $query = "SELECT id FROM jugador WHERE battlenet = :bt AND usuario != :usuario";
        $statement = $connection->prepare($query);
        $statement->bindParam(':usuario', $this->user);
        $statement->bindParam(':bt', $bt);
        $result = $statement->execute();
        $affectedRows = $statement->rowCount();

        if($affectedRows > 0){
            return ['status' => 0, 'msg' => "Este BT ya se encuentra vinculado a otro usuario"];
        }

        
        $query = "UPDATE jugador SET perfil = :imgPerfil, battlenet = :bt, twitch = :ttv, twitter = :tw WHERE usuario = :usuario";
        $statement = $connection->prepare($query);

        $statement->bindParam(':usuario', $this->user);
        $statement->bindParam(':bt', $bt);
        $statement->bindParam(':ttv', $ttv);
        $statement->bindParam(':tw', $tw);
        $statement->bindParam(':imgPerfil', $img);

        // Ejecuta la consulta
        $result = $statement->execute();

        // Obtiene el resultado de la consulta
        $affectedRows = $statement->rowCount();

        if ($result) {
            $affectedRows = $statement->rowCount();
            if ($affectedRows > 0) {
                return ['status' => 1, 'msg' => "Datos actualizados correctamente"];
            } else {
                if($statement->errorInfo()[2] == null){
                    return ['status' => 0, 'msg' => "No hay cambios que guardar"];
                }else{
                    return ['status' => 0, 'msg' => "No se realizaron cambios en los datos"];
                }
                
            }
        } else {
            $errorInfo = $statement->errorInfo();
            return ['status' => 0, 'msg' => "Ocurrió un error al actualizar tus datos", "error" => $errorInfo];
        }
    }

    public function getFotosPerfil(){

        // Obtiene la conexión
        $connection = $this->db->getConnection();
        // Prepara la consulta para buscar el nombre de usuario en la base de datos
        $query = "SELECT * FROM img_perfil ORDER BY nombre ASC";
        $statement = $connection->prepare($query);

        // Ejecuta la consulta
        $statement->execute();

        // Obtiene el resultado de la consulta
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        if($affectedRows > 0){
            return ['status' => 1, 'data' => $result];
        }else{
            return ['status' => 0];
        }
    }

    public function getDatosPerfil(){

        // Obtiene la conexión
        $connection = $this->db->getConnection();
        // Prepara la consulta para buscar el nombre de usuario en la base de datos
        $query = "SELECT id, usuario, perfil, battlenet, twitch, twitter FROM jugador WHERE usuario = :usuario";
        $statement = $connection->prepare($query);

        // Asigna el valor del parámetro de consulta
        $statement->bindParam(':usuario', $this->user);

        // Ejecuta la consulta
        $statement->execute();

        // Obtiene el resultado de la consulta
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        if($affectedRows > 0){
            return ['status' => 1, 'data' => $result];
        }else{
            return ['status' => 0];
        }


    }

    public function getDatosPerfilJugador(){

        $jugador = $_POST['jugador'];

        // Obtiene la conexión
        $connection = $this->db->getConnection();
        // Prepara la consulta para buscar el nombre de usuario en la base de datos
        $query = "SELECT id, usuario, perfil, battlenet, twitch, twitter FROM jugador WHERE id = :usuario";
        $statement = $connection->prepare($query);

        // Asigna el valor del parámetro de consulta
        $statement->bindParam(':usuario', $jugador);

        // Ejecuta la consulta
        $statement->execute();

        // Obtiene el resultado de la consulta
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        if($affectedRows > 0){
            return ['status' => 1, 'data' => $result];
        }else{
            return ['status' => 0];
        }


    }

    public function eliminarJugador(){
        
        $jugador = $_POST['jugador'];
        $equipo = $_POST['equipo'];

        // Obtiene la conexión
        $connection = $this->db->getConnection();

        $query = "SELECT creador FROM equipo WHERE id = :idEquipo AND creador = :user";
        $statement = $connection->prepare($query);

        // Asigna el valor del parámetro de consulta
        $statement->bindParam(':idEquipo', $equipo);
        $statement->bindParam(':user', $this->user);

        // Ejecuta la consulta
        $statement->execute();

        // Obtiene el resultado de la consulta
        $affectedRows = $statement->rowCount();

        if($affectedRows == 0){
            return ['status' => 0, "msg" => "No tienes privilegios para realizar esta acción"];
        }

        $query = "DELETE FROM equipo_jugador WHERE id_equipo = :idEquipo AND id_jugador = :idJugador";
        $statement = $connection->prepare($query);
        $statement->bindParam(':idJugador', $jugador);
        $statement->bindParam(':idEquipo', $equipo);
        $statement->execute();
        $resultJugadores = $statement->fetchAll(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        if($affectedRows == 0){
            return ['status' => 0, 'msg' => "Ocurrió un error al eliminar al jugador del equipo, por favor reintenta"];
        }

        return ['status' => 1, 'msg' => "Jugador eliminado correctamente"];

    }

    public function inscribirEquipo(){

        $equipo = $_POST['equipo'];
        $torneo = $_POST['torneo'];

        $connection = $this->db->getConnection();
        $query = "SELECT * FROM equipo_jugador WHERE id_equipo = :equipo";
        $statement = $connection->prepare($query);
        $statement->bindParam(':equipo', $equipo);
        $statement->execute();
        $jugadores = $statement->fetchAll(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        if($affectedRows < 5){
            return ['status' => 0, 'msg' => "El equipo debe contar con al menos 5 jugadores para poder participar"];
        }

        $jugadorArray = array();
        foreach($jugadores as $item){
            $jugadorArray[] = $item['id_jugador']; 
        }

        $jugadorArray = implode("','", $jugadorArray);

        $query = "SELECT * FROM equipo_jugador WHERE id_jugador IN ('$jugadorArray') AND id_equipo != '$equipo' ";
        $statement = $connection->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        if($affectedRows > 0){
            return ['status' => 0, 'msg' => "Un jugador de tu equipo ya se encuentra registrado en este torneo con un equipo diferente"];
        }

        //Si paso las validaciones entonces el equipo se puede isncribir
        $query = "INSERT INTO torneo_equipo (torneo, equipo) VALUES (:torneo, :equipo)";
        $statement = $connection->prepare($query);
        $statement->bindParam(':equipo', $equipo);
        $statement->bindParam(':torneo', $torneo);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        if($affectedRows == 0){
            return ['status' => 0, 'msg' => "Ocurrió un error al inscribirse, por favor reintenta"];
        }
        
        return ['status' => 1, 'msg' => "Equipo inscrito correctamente"];
    }

    public function getDatosEquipo(){

        $idEquipo = $_POST['idEquipo'];

        // Obtiene la conexión
        $connection = $this->db->getConnection();
        // Prepara la consulta para buscar el nombre de usuario en la base de datos
        $query = "SELECT * FROM equipo WHERE id = :id";
        $statement = $connection->prepare($query);

        // Asigna el valor del parámetro de consulta
        $statement->bindParam(':id', $idEquipo);

        // Ejecuta la consulta
        $statement->execute();

        // Obtiene el resultado de la consulta
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        if($affectedRows > 0){

            $query = "SELECT j.id, j.usuario, j.perfil, j.battlenet FROM equipo_jugador e LEFT JOIN jugador j ON j.id=e.id_jugador WHERE e.id_equipo = :id";
            $statement = $connection->prepare($query);
            $statement->bindParam(':id', $idEquipo);
            $statement->execute();
            $resultJugadores = $statement->fetchAll(PDO::FETCH_ASSOC);
            $affectedRows = $statement->rowCount();


            return ['status' => 1, 'data' => $result, 'miembros' => $resultJugadores];
        }else{
            return ['status' => 0];
        }
    }

    public function buscarJugador(){
        
        $busqueda = '%' . $_POST['busqueda'] . '%';

        // Obtiene la conexión
        $connection = $this->db->getConnection();

        // Prepara la consulta para buscar el nombre de usuario en la base de datos
        $query = "SELECT id, usuario, battlenet, perfil FROM jugador WHERE (usuario LIKE :usuario OR battlenet LIKE :usuario)  AND usuario != :yo";
        $statement = $connection->prepare($query);

        // Asigna el valor del parámetro de consulta
        $statement->bindParam(':usuario', $busqueda);
        $statement->bindParam(':yo', $this->user);

        // Ejecuta la consulta
        $statement->execute();

        // Obtiene el resultado de la consulta
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        if ($affectedRows > 0) {
            return ['status' => 1, 'data' => $result];
        } else {
            return ['status' => 0];
        }

    }

    public function updtInvitacion(){

        $tipo = $_POST['tipo'];
        $inv = $_POST['invitacion'];

        $connection = $this->db->getConnection();
        $query = " UPDATE invitacion SET status = :tipo WHERE id = :idInv ";
        $statement = $connection->prepare($query);
        $statement->bindParam(':tipo', $tipo);
        $statement->bindParam(':idInv', $inv); 

        // Ejecuta la consulta
        $statement->execute();

        // Obtiene el resultado de la consulta
        $resultInv = $statement->fetch(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        if ($affectedRows == 0) {
            return ['status' => 0, 'msg' => "Ocurrió un error, por favor reintente.."];
        }

        $query = " SELECT equipo, jugador FROM invitacion WHERE id = :idInv ";
        $statement = $connection->prepare($query);
        $statement->bindParam(':idInv', $inv); 

        // Ejecuta la consulta
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $equipoInv = $result['equipo'];
        $jugadorInv = $result['jugador'];

        $query = "SELECT id FROM equipo_jugador WHERE id_jugador = :idJ AND id_equipo = :idE";
        $statement = $connection->prepare($query);
        // Asigna los valores a los parámetros de la consulta
        $statement->bindParam(':idJ', $jugadorInv);
        $statement->bindParam(':idE', $equipoInv);

        // Ejecuta la consulta
        $statement->execute();
        $affectedRows = $statement->rowCount();

        if($affectedRows > 0){
            return ['status' => 1, 'msg' => "Este jugador ya pertenece a este equipo"];
        }


        $query = "INSERT INTO equipo_jugador (id_jugador, id_equipo) VALUES (:idJ, :idE)";
        $statement = $connection->prepare($query);

        // Asigna los valores a los parámetros de la consulta
        $statement->bindParam(':idJ', $jugadorInv);
        $statement->bindParam(':idE', $equipoInv);

        // Ejecuta la consulta
        $statement->execute();

        //Obtener torneo inscrito actual
        $query = "SELECT torneo FROM torneo_equipo WHERE equipo = :idE";
        $statement = $connection->prepare($query);
        $statement->bindParam(':idE', $equipoInv);
        $statement->execute();
        $torneoActual = $statement->fetch(PDO::FETCH_COLUMN);

        //validar cambios en torneo actual
        $query = "SELECT id, cambios FROM cambios WHERE equipo = :idE AND torneo = :idTorneo";
        $statement = $connection->prepare($query);
        $statement->bindParam(':idE', $equipoInv);
        $statement->bindParam(':idTorneo', $torneoActual);
        $statement->execute();
        $cambios = $statement->fetch(PDO::FETCH_COLUMN);
        $affectedRows = $statement->rowCount();


        $query = "SELECT iniciado FROM torneo WHERE id = :idTorneo AND iniciado = 1";
        $statement = $connection->prepare($query);
        $statement->bindParam(':idTorneo', $torneoActual);
        $statement->execute();
        $torneoIniciado = $statement->rowCount();


        if($torneoIniciado > 0){

            $cambios += $cambios+1;

            if($affectedRows > 0){
                $query = "UPDATE cambios SET cambios = :cambios WHERE equipo = :idE AND torneo = :idTorneo";
                $statement = $connection->prepare($query);
                $statement->bindParam(':cambios', $cambios);
                $statement->bindParam(':idE', $equipoInv);
                $statement->bindParam(':idTorneo', $torneoActual);
                $statement->execute();
                $affectedRows = $statement->rowCount();
            }else{
                $cambios = 1;

                $query = "INSERT INTO cambios SET cambios = :cambios, equipo = :idE, torneo = :idTorneo";
                $statement = $connection->prepare($query);
                $statement->bindParam(':cambios', $cambios);
                $statement->bindParam(':idE', $equipoInv);
                $statement->bindParam(':idTorneo', $torneoActual);
                $statement->execute();
                $affectedRows = $statement->rowCount();
            }

            if ($affectedRows == 0) {
                return ['status' => 0, 'msg' => "Ocurrió un error, por favor reintente..."];
            }

        }

        

        return ['status' => 1, 'msg' => ""];

    }

    public function getInvitaciones(){

        $connection = $this->db->getConnection();
        $query = "SELECT i.id, i.equipo, e.nombre, e.logo FROM invitacion i LEFT JOIN equipo e  ON e.id = i.equipo  WHERE i.jugador = :jugador AND i.status = '2' ";
        $statement = $connection->prepare($query);
        $statement->bindParam(':jugador', $this->idUser);

        // Ejecuta la consulta
        $statement->execute();

        // Obtiene el resultado de la consulta
        $resultInv = $statement->fetchAll(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        if ($affectedRows == 0) {
            return ['status' => 0, 'msg' => "Sin invitaciones pendientes"];
        }


        return ['status' => 1, 'msg' => "Invitaciones encontradas", 'data' => $resultInv, 'total' => $affectedRows];

    }

    public function getNotificaciones(){

        $connection = $this->db->getConnection();
        $query = "SELECT id, titulo, mensaje FROM notificacion where jugador = :jugador ";
        $statement = $connection->prepare($query);
        $statement->bindParam(':jugador', $this->idUser);

        // Ejecuta la consulta
        $statement->execute();

        // Obtiene el resultado de la consulta
        $resultInv = $statement->fetchAll(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        if ($affectedRows == 0) {
            return ['status' => 0, 'msg' => "Sin notificaciones pendientes"];
        }


        return ['status' => 1, 'data' => $resultInv];

    }

    public function invitarJugador(){
        
        $jugador = $_POST['jugador'];
        $equipo = $_POST['equipo'];

        // Obtiene la conexión
        $connection = $this->db->getConnection();

        $query = "SELECT creador FROM equipo WHERE id = :idEquipo AND creador = :user";
        $statement = $connection->prepare($query);

        // Asigna el valor del parámetro de consulta
        $statement->bindParam(':idEquipo', $equipo);
        $statement->bindParam(':user', $this->user);

        // Ejecuta la consulta
        $statement->execute();

        // Obtiene el resultado de la consulta
        $affectedRows = $statement->rowCount();

        if($affectedRows == 0){
            return ['status' => 0, "msg" => "No tienes privilegios para realizar esta acción"];
        }

        //Obtener torneo inscrito actual
        $query = "SELECT torneo FROM torneo_equipo WHERE equipo = :idE";
        $statement = $connection->prepare($query);
        $statement->bindParam(':idE', $equipo);
        $statement->execute();
        $torneoActual = $statement->fetch(PDO::FETCH_COLUMN);

        //validar cambios en torneo actual
        $query = "SELECT cambios FROM cambios WHERE equipo = :idE AND torneo = :idTorneo";
        $statement = $connection->prepare($query);
        $statement->bindParam(':idE', $equipo);
        $statement->bindParam(':idTorneo', $torneoActual);
        $statement->execute();
        $cambios = $statement->fetch(PDO::FETCH_COLUMN);
        $affectedRows = $statement->rowCount();

        if($cambios >= 5){
            return ['status' => 0, "msg" => "Has alcanzado el límite máximo de 5 cambios para este torneo"];
        }


        $query = "SELECT id_jugador, id_equipo FROM equipo_jugador WHERE id_equipo = :equipo AND id_jugador = :jugador ";
        $statement = $connection->prepare($query);
        $statement->bindParam(':equipo', $equipo);
        $statement->bindParam(':jugador', $jugador);

        // Ejecuta la consulta
        $statement->execute();

        // Obtiene el resultado de la consulta
        $resultInv = $statement->fetchAll(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        if ($affectedRows > 0) {

            return ['status' => 0, 'msg' => "Este jugador ya pertenece a este equipo"];
        }

        $query = "SELECT id FROM invitacion WHERE equipo = :equipo AND jugador = :jugador AND status = 2 ";
        $statement = $connection->prepare($query);
        $statement->bindParam(':equipo', $equipo);
        $statement->bindParam(':jugador', $jugador);

        // Ejecuta la consulta
        $statement->execute();

        // Obtiene el resultado de la consulta
        $resultInv = $statement->fetchAll(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        if ($affectedRows > 0) {

            return ['status' => 0, 'msg' => "Ya existe una invitación pendiente para este jugador"];
        }

        // Prepara la consulta para buscar el nombre de usuario en la base de datos
        $query = "INSERT INTO invitacion (equipo, jugador) VALUES (:equipo, :jugador)";
        $statement = $connection->prepare($query);

        // Asigna el valor del parámetro de consulta
        $statement->bindParam(':equipo', $equipo);
        $statement->bindParam(':jugador', $jugador);

        // Ejecuta la consulta
        $statement->execute();

        // Obtiene el resultado de la consulta
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $affectedRows = $statement->rowCount();

        if ($affectedRows > 0) {
            return ['status' => 1, 'invs' => $resultInv];
        } else {
            return ['status' => 0];
        }

    }


    public function generateSchedule() {

        $torneoId = $_POST['torneo'];
        $connection = $this->db->getConnection();
        $query = "SELECT equipo FROM torneo_equipo WHERE torneo = :torneoId";
        $statement = $connection->prepare($query);
        $statement->bindParam(':torneoId', $torneoId);
        $statement->execute();
        $equipos = $statement->fetchAll(PDO::FETCH_COLUMN);
    
        $totalEquipos = count($equipos);
    
        if ($totalEquipos % 2 !== 0) {
            array_push($equipos, -1); // Agregar un equipo ficticio con id = -1 para equipos impares
            $totalEquipos++;
        }
    
        $calendario = [];
    
        for ($jornada = 1; $jornada < $totalEquipos; $jornada++) {
            $calendario[$jornada] = [];
    
            shuffle($equipos); // Reordenar aleatoriamente los equipos
    
            for ($i = 0; $i < $totalEquipos / 2; $i++) {
                if ($i === 0) {
                    $equipo1 = $equipos[$i];
                    $equipo2 = $equipos[$totalEquipos - 1];
                } else {
                    $equipo1 = $equipos[$i];
                    $equipo2 = $equipos[$totalEquipos - 1 - $i];
                }
    
                $calendario[$jornada][] = ['equipo1' => $equipo1, 'equipo2' => $equipo2];
            }
    
            array_splice($equipos, 1, 0, array_pop($equipos));
    
            // Realizar inserción en la tabla "jornada"
            $insertJornadaQuery = "INSERT INTO jornada (numero, torneo) VALUES (:numero, :torneo)";
            $insertJornadaStatement = $connection->prepare($insertJornadaQuery);
            $insertJornadaStatement->bindParam(':numero', $jornada);
            $insertJornadaStatement->bindParam(':torneo', $torneoId);
            $insertJornadaStatement->execute();

            // Obtener el ID de la jornada recién insertada
            $jornadaId = $connection->lastInsertId();

            //Mapa 1 - control
            $randomMapaQuery = "SELECT id FROM mapa WHERE tipo = 'control' AND activo = 1 ORDER BY RAND() LIMIT 1";
            $randomMapaStatement = $connection->prepare($randomMapaQuery);
            $randomMapaStatement->execute();
            $mapa1 = $randomMapaStatement->fetchColumn();

            //Mapa 2 - escolta
            $randomMapaQuery = "SELECT id FROM mapa WHERE tipo = 'escolta' AND activo = 1 ORDER BY RAND() LIMIT 1";
            $randomMapaStatement = $connection->prepare($randomMapaQuery);
            $randomMapaStatement->execute();
            $mapa2 = $randomMapaStatement->fetchColumn();

            //Mapa 3 - Hibrido
            $randomMapaQuery = "SELECT id FROM mapa WHERE tipo = 'hibrido' AND activo = 1 ORDER BY RAND() LIMIT 1";
            $randomMapaStatement = $connection->prepare($randomMapaQuery);
            $randomMapaStatement->execute();
            $mapa3 = $randomMapaStatement->fetchColumn();

            //Mapa 4 - Critico o push
            $randomMapaQuery = "SELECT id FROM mapa WHERE (tipo = 'critico' OR tipo = 'push') AND activo = 1 ORDER BY RAND() LIMIT 1";
            $randomMapaStatement = $connection->prepare($randomMapaQuery);
            $randomMapaStatement->execute();
            $mapa4 = $randomMapaStatement->fetchColumn();

            // Realizar 4 inserciones en la tabla "encuentro" con los mapas seleccionados al azar
            foreach ($calendario[$jornada] as $encuentro) {

                $insertEncuentroQuery = "INSERT INTO encuentro (jornada, equipo1, equipo2, mapa) VALUES (:jornada, :equipo1, :equipo2, :mapa)";
                $insertEncuentroStatement = $connection->prepare($insertEncuentroQuery);
                $insertEncuentroStatement->bindParam(':jornada', $jornadaId);
                $insertEncuentroStatement->bindParam(':equipo1', $encuentro['equipo1']);
                $insertEncuentroStatement->bindParam(':equipo2', $encuentro['equipo2']);
                $insertEncuentroStatement->bindParam(':mapa', $mapa1);
                $insertEncuentroStatement->execute();

                $insertEncuentroQuery = "INSERT INTO encuentro (jornada, equipo1, equipo2, mapa) VALUES (:jornada, :equipo1, :equipo2, :mapa)";
                $insertEncuentroStatement = $connection->prepare($insertEncuentroQuery);
                $insertEncuentroStatement->bindParam(':jornada', $jornadaId);
                $insertEncuentroStatement->bindParam(':equipo1', $encuentro['equipo1']);
                $insertEncuentroStatement->bindParam(':equipo2', $encuentro['equipo2']);
                $insertEncuentroStatement->bindParam(':mapa', $mapa2);
                $insertEncuentroStatement->execute();

                $insertEncuentroQuery = "INSERT INTO encuentro (jornada, equipo1, equipo2, mapa) VALUES (:jornada, :equipo1, :equipo2, :mapa)";
                $insertEncuentroStatement = $connection->prepare($insertEncuentroQuery);
                $insertEncuentroStatement->bindParam(':jornada', $jornadaId);
                $insertEncuentroStatement->bindParam(':equipo1', $encuentro['equipo1']);
                $insertEncuentroStatement->bindParam(':equipo2', $encuentro['equipo2']);
                $insertEncuentroStatement->bindParam(':mapa', $mapa3);
                $insertEncuentroStatement->execute();

                $insertEncuentroQuery = "INSERT INTO encuentro (jornada, equipo1, equipo2, mapa) VALUES (:jornada, :equipo1, :equipo2, :mapa)";
                $insertEncuentroStatement = $connection->prepare($insertEncuentroQuery);
                $insertEncuentroStatement->bindParam(':jornada', $jornadaId);
                $insertEncuentroStatement->bindParam(':equipo1', $encuentro['equipo1']);
                $insertEncuentroStatement->bindParam(':equipo2', $encuentro['equipo2']);
                $insertEncuentroStatement->bindParam(':mapa', $mapa4);
                $insertEncuentroStatement->execute();
            }
        }
    
        return $calendario;
    }

    public function getStats(){

        $connection = $this->db->getConnection();

        //Equipos registrados
        $query = "SELECT COUNT(id) as total FROM equipo";
        $statement = $connection->prepare($query);
        $statement->execute();
        $totalEquipos = $statement->fetch(PDO::FETCH_COLUMN);

        //Total usuarios
        $query = "SELECT COUNT(id) as total FROM jugador";
        $statement = $connection->prepare($query);
        $statement->execute();
        $totalJugadores = $statement->fetch(PDO::FETCH_COLUMN);


        return ['status' => 1, 'equipos' => $totalEquipos, 'jugadores' => $totalJugadores];
    }

    public function showCalendarioEquipo(){

        $equipo = $_POST['equipo'];
        $torneoId = $_POST['torneo'];

        $connection = $this->db->getConnection();
        
        //traer jornadas pertenecientes al torneo
        $query = "SELECT id, numero FROM jornada WHERE torneo = :torneoId";
        $statement = $connection->prepare($query);
        $statement->bindParam(':torneoId', $torneoId);
        $statement->execute();
        $jornadas = $statement->fetchAll(PDO::FETCH_ASSOC);
        $jornadasAfected = $statement->rowCount();


        //Traer encuentros pertenecientes a las jornadas
        if($jornadasAfected > 0){

            $matches = array();

            $isOwner = 0;
            foreach($jornadas as $jornada){
                $match = array();

                $query = "SELECT e.fecha, e.hora, e.reportar, j.perfil as caster_foto, j.usuario as caster_nombre, j.twitch as caster_twitch, e.caster, e.equipo1 as reportador, eq1.nombre as equipo1, e.equipo1 as equipo1_id, e.equipo2 as equipo2_id, eq2.nombre as equipo2, 
                    m.nombre as mapa, m.imagen as imagen_mapa, e.id, e.vencedor FROM encuentro e 
                JOIN equipo eq1 ON e.equipo1 = eq1.id  
                JOIN equipo eq2 ON e.equipo2 = eq2.id 
                JOIN mapa m ON e.mapa = m.id
                LEFT JOIN jugador j ON j.id=e.caster
                WHERE e.jornada = :jornada AND (e.equipo1 = :equipo OR e.equipo2 = :equipo ) ";

                $statement = $connection->prepare($query);
                $statement->bindParam(':equipo', $equipo);
                $statement->bindParam(':jornada', $jornada['id']);
                $statement->execute();
                $encuentros = $statement->fetchAll(PDO::FETCH_ASSOC);

                $fechaEncuentro = "";
                $horaEncuentro = "";

                foreach ($encuentros as $encuentro) {
                    $equipoReporta = $encuentro['reportador'];
                    $fechaEncuentro = $encuentro['fecha'];
                    $horaEncuentro = $encuentro['hora'];
                    
                    $query = "SELECT creador FROM equipo WHERE id = :equipo AND creador = :yo";
                    $statement = $connection->prepare($query);
                    $statement->bindParam(':equipo', $equipoReporta);
                    $statement->bindParam(':yo', $this->user);
                    $statement->execute();
                    //$encuentros = $statement->fetch(PDO::FETCH_ASSOC);
                    $isOwner = $statement->rowCount();
                }

                $match['fecha'] = $fechaEncuentro;
                $match['hora'] = $horaEncuentro;
                $match['jornada'] = $jornada['numero'];
                $match['reporta'] = $isOwner;
                
                $match['matches'] = $encuentros;
                $matches[] = $match;
            }

            

            return ['status' => 1, 'data' => $matches];
            
        }

    }

    public function setVencedorEncuentro(){

        $encuentro = $_POST['encuentro'];
        $vencedor = $_POST['vencedor'];

        $connection = $this->db->getConnection();

        $query = "SELECT equipo1 FROM encuentro WHERE id = :encuentro ";
        $statement = $connection->prepare($query);
        $statement->bindParam(':encuentro', $encuentro);
        $statement->execute();
        $equipo1 = $statement->fetch(PDO::FETCH_COLUMN);

        $query = "SELECT id FROM encuentro WHERE id = :encuentro AND vencedor IS NULL ";
        $statement = $connection->prepare($query);
        $statement->bindParam(':encuentro', $encuentro);
        $statement->execute();
        $afected = $statement->rowCount();
        if($afected == 0){
            return ['status' => 0, 'msg' => "Este encuentro no puede ser modificado" ];
        }


        $query = "SELECT creador FROM equipo WHERE id = :equipo";
        $statement = $connection->prepare($query);
        $statement->bindParam(':equipo', $equipo1);
        $statement->execute();
        $owner = $statement->fetch(PDO::FETCH_COLUMN);

        if($owner != $this->user){
            return ['status' => 0, 'msg' => "No tienes permiso para realizar esta acción" ];
        }


        $query = "UPDATE encuentro SET vencedor = :vencedor WHERE id = :encuentro ";
        $statement = $connection->prepare($query);
        $statement->bindParam(':vencedor', $vencedor);
        $statement->bindParam(':encuentro', $encuentro);
        $result = $statement->execute();

        if($result){
            return ['status' => 1, 'msg' => "Encuentro actualizado correctamente" ];
        }else{

            return ['status' => 0, 'msg' => "Ocurrió un error, por favor reintenta" ];
        }
        
    }

    public function setVencedorEncuentroAdmin(){

        $vencedor = $_POST['vencedor'];
        $encuentro = $_POST['encuentro'];

        $connection = $this->db->getConnection();

        $query = "UPDATE encuentro SET vencedor = '$vencedor' WHERE id = '$encuentro' ";
        $statement = $connection->prepare($query);
        $statement->execute();

        $affectedRows = $statement->rowCount();

        if ($affectedRows > 0) {
            return ['status' => 1, 'msg' => "Vencedor actualizado correctamente"];
        } else {
            return ['status' => 0, 'msg' => "Ocurrió un error, por favor reintenta"];
        }

    }

    public function getEncuentros(){

        $jornada = $_POST['jornada'];

        $connection = $this->db->getConnection();


        $query = "SELECT jn.numero, e.reportar, j.perfil as caster_foto, j.usuario as caster_nombre, j.twitch as caster_twitch, e.caster, e.equipo1 as reportador, eq1.nombre as equipo1, e.equipo1 as equipo1_id, e.equipo2 as equipo2_id, eq2.nombre as equipo2, 
                    m.nombre as mapa, m.imagen as imagen_mapa, e.id, (SELECT nombre FROM equipo WHERE id = e.vencedor) as vencedor FROM encuentro e 
                JOIN equipo eq1 ON e.equipo1 = eq1.id  
                JOIN equipo eq2 ON e.equipo2 = eq2.id 
                JOIN mapa m ON e.mapa = m.id
                JOIN jornada jn ON jn.id = e.jornada
                LEFT JOIN jugador j ON j.id=e.caster WHERE e.jornada = '$jornada' ";
        $statement = $connection->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        if($result){
            return ['status' => 1, 'msg' => "", 'data' => $result ];
        }else{

            return ['status' => 0, 'msg' => "Ocurrió un error, por favor reintenta" ];
        }

    }

    public function getCalendario(){

        $torneoId = $_POST['torneo'];

        $connection = $this->db->getConnection();

        $query = "SELECT id FROM torneo WHERE iniciado = '1' AND id = :torneoId";
        $statement = $connection->prepare($query);
        $statement->bindParam(':torneoId', $torneoId);
        $statement->execute();
        $torneoAfected = $statement->rowCount();

        if ($torneoAfected == 0) {
            return ['status' => 0, 'msg' => "El calendario de encuentros aún no se encuentra listo"];
        }

        
        //Traer equipos inscritos al torneo
        $query = "SELECT t.equipo as id, e.nombre, e.logo FROM torneo_equipo t LEFT JOIN equipo e ON e.id=t.equipo WHERE t.torneo = :torneoId";
        $statement = $connection->prepare($query);
        $statement->bindParam(':torneoId', $torneoId);
        $statement->execute();
        $equipos = $statement->fetchAll(PDO::FETCH_ASSOC);
        $equiposAfected = $statement->rowCount();

        //traer jornadas pertenecientes al torneo
        $query = "SELECT id FROM jornada WHERE torneo = :torneoId";
        $statement = $connection->prepare($query);
        $statement->bindParam(':torneoId', $torneoId);
        $statement->execute();
        $jornadas = $statement->fetchAll(PDO::FETCH_COLUMN);
        $jornadasAfected = $statement->rowCount();


        if($equiposAfected > 0){

            //Traer encuentros pertenecientes a las jornadas
            if($jornadasAfected > 0){

                $jornadasArray = array();
                foreach($jornadas as $item){
                    $jornadasArray[] = $item; 
                }

                $jornadasArray = implode("','", $jornadasArray);


                $arrayEquipos = array();

                foreach($equipos as $equipo){

                    //Traemos sus victorias
                    $query = "SELECT count(id) as victorias FROM encuentro WHERE jornada IN ('$jornadasArray') AND (equipo1 = :equipo OR equipo2 = :equipo ) AND vencedor = :equipo ";
                    $statement = $connection->prepare($query);
                    $statement->bindParam(':equipo', $equipo['id']);
                    $statement->execute();
                    $victorias = $statement->fetch(PDO::FETCH_ASSOC);
                    
                    //Traemos sus derrotas
                    $query = "SELECT count(id) as derrotas FROM encuentro WHERE jornada IN ('$jornadasArray') AND (equipo1 = :equipo OR equipo2 = :equipo ) AND vencedor != :equipo AND vencedor != '0' ";
                    $statement = $connection->prepare($query);
                    $statement->bindParam(':equipo', $equipo['id']);
                    $statement->execute();
                    $derrotas = $statement->fetch(PDO::FETCH_ASSOC);

                    //Traemos sus empates
                    $query = "SELECT count(id) as empates FROM encuentro WHERE jornada IN ('$jornadasArray') AND (equipo1 = :equipo OR equipo2 = :equipo ) AND vencedor = '0' ";
                    $statement = $connection->prepare($query);
                    $statement->bindParam(':equipo', $equipo['id']);
                    $statement->execute();
                    $empates = $statement->fetch(PDO::FETCH_ASSOC);


                    //Contabilizar puntos  Victoria = 3 pts - Empate = 1 pt - Derrota = 0 pts
                    $puntos = 0;

                    $ptsVictorias = (int) $victorias['victorias'] * 3;
                    $ptsEmpates = (int) $empates['empates'] * 1;

                    $puntos = $ptsVictorias + $ptsEmpates;


                    $equipo['victorias'] = $victorias['victorias'];
                    $equipo['derrotas'] = $derrotas['derrotas'];
                    $equipo['empates'] = $empates['empates'];
                    $equipo['puntos'] = $puntos;
                    //$victorias['equipo'] = $equipo;


                    $arrayEquipos[] = $equipo;

                }

                

                return ['status' => 1, 'data' => $arrayEquipos];
                
            }

        }else{
            return ['status' => 0, 'msg' => "Sin equipos disponibles"];
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
    echo json_encode(['status' => 0, 'msg' => "Método no existente: $method"]);
    http_response_code(409);
}
