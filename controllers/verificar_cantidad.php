<?php
header('Content-Type: application/json');
include_once 'db.php';
$data = json_decode(file_get_contents('php://input'));
$idProducto = $data->id;
if (!$idProducto) {
    echo json_encode(['success' => false, 'message' => 'ID del producto no proporcionado']);
    exit();
}
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
$sql = "SELECT cantidad FROM productos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idProducto);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(['success' => true, 'cantidadDisponible' => $row['cantidad']]);
} else {
    echo json_encode(['success' => false, 'message' => 'Producto no encontrado']);
}
$conn->close();
?>