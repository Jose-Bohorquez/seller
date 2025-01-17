<?php
$servername = "localhost";
$username = "root"; // Usuario de la base de datos
$password = ""; // Escapa las barras inclinadas dobles
$dbname = "seller"; // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>