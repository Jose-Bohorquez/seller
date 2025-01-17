<?php

require_once "models/Product.php";

class CarritoController {
    private $productModel;

    public function __construct() {
        $this->productModel = new Product(); // Instancia del modelo Product
    }

    public function verificarCantidad() {
        $rawData = file_get_contents('php://input');
        $data = json_decode($rawData, true);

        if (!isset($data['id'])) {
            echo json_encode(['success' => false, 'message' => 'ID del producto no proporcionado']);
            return;
        }

        $idProducto = $data['id'];
        $producto = $this->productModel->get_product_by_id($idProducto);

        if ($producto) {
            $cantidadDisponible = $producto->get_amount();
            echo json_encode(['success' => true, 'cantidadDisponible' => $cantidadDisponible]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Producto no encontrado']);
        }
    }

    public function actualizarCantidad() {
        $rawData = file_get_contents('php://input');
        $data = json_decode($rawData, true);

        if (!isset($data['id']) || !isset($data['cantidad'])) {
            echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
            return;
        }

        $id = $data['id'];
        $cantidad = $data['cantidad'];

        try {
            $this->productModel->restablecer_cantidad($id, $cantidad);
            echo json_encode(['success' => true, 'message' => 'Cantidad actualizada correctamente']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el producto: ' . $e->getMessage()]);
        }
    }

    public function agregarAlCarrito() {
        header('Content-Type: application/json');
        try {
            $id = $_POST['id'] ?? null;
            if (!$id) {
                echo json_encode(['success' => false, 'message' => 'ID de producto no proporcionado']);
                return;
            }

            // Lógica para agregar el producto al carrito...

            echo json_encode(['success' => true, 'message' => 'Producto agregado al carrito']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error interno: ' . $e->getMessage()]);
        }
    }

}
