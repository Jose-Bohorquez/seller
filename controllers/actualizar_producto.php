<?php
include_once 'db.php';
header('Content-Type: application/json');
$rawData = file_get_contents('php://input');
if (!$rawData) {
    echo json_encode(['success' => false, 'message' => 'No se recibió ningún dato']);
    exit;
}
$data = json_decode($rawData, true);
if ($data === null) {
    echo json_encode(['success' => false, 'message' => 'Error al leer los datos JSON']);
    exit;
}
if (isset($data['id']) && isset($data['cantidad'])) {
    $id = $data['id'];
    $cantidad = $data['cantidad'];
    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'message' => 'Conexión fallida: ' . $conn->connect_error]);
        exit;
    }
    $sql = "UPDATE productos SET cantidad = cantidad + ? WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ii", $cantidad, $id);        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Cantidad actualizada correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el producto']);
        }   
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta']);
    }    
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
}
header('Content-Type: application/json');
echo json_encode([
    'success' => true,
    'message' => 'Producto actualizado correctamente'
]);
?>