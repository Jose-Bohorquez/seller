<?php
    
class DataBase {

    public static function connection() {  

        // Configuración de la base de datos
        $hostname = "localhost";
        $port = "3306";
        $database = "seller";   // ajustar (nombre BD) en qa servidor de pruebas
        $username = "root";     // ajustar (usuario BD) en qa servidor de pruebas
        $password = "";         // ajustar (Contraseña de BD) en qa servidor de pruebas

        try {
            // Crear la conexión PDO
            $pdo = new PDO("mysql:host=$hostname;port=$port;dbname=$database;charset=utf8", $username, $password);

            // Establecer el modo de error a excepción
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // mandar mensaje de test de conexion exitosa
            #echo "conexion a BD exitosa";

            // Retornar la conexión
            return $pdo;

        } catch (PDOException $e) {
            // Si ocurre un error de conexión, se captura la excepción y muestra el mensaje
            echo "Error de conexión a la base de datos: " . $e->getMessage();
            // Se puede hacer un manejo adicional del error, como registrar el error en un archivo de log
        }
    }
}
?>
