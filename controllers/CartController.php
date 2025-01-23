<?php
require_once "models/Product.php";

class CartController {
    private $productModel;

    public function __construct() {
        $this->productModel = new Product();
    }

    // Agregar producto al carrito
    public function addToCart() {
        try {
            session_start();
            $productId = $_POST['id'] ?? null;
            $quantity = $_POST['quantity'] ?? 1;

            if (!$productId) {
                throw new Exception("ID del producto no proporcionado");
            }

            $product = $this->productModel->get_product_by_id($productId);

            if (!$product) {
                throw new Exception("Producto no encontrado");
            }

            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = [];
            }

            if (isset($_SESSION['carrito'][$productId])) {
                $_SESSION['carrito'][$productId]['cantidad'] += $quantity;
                $_SESSION['carrito'][$productId]['subtotal'] = $_SESSION['carrito'][$productId]['cantidad'] * $product->get_price();
            } else {
                $_SESSION['carrito'][$productId] = [
                    'id' => $productId,
                    'nombre' => $product->get_name(),
                    'precio' => $product->get_price(),
                    'cantidad' => $quantity,
                    'subtotal' => $product->get_price() * $quantity,
                ];
            }

            echo json_encode(['success' => true, 'carrito' => $_SESSION['carrito']]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // Mostrar productos del carrito
    public function showCart() {
        try {
            session_start();
            $cart = $_SESSION['carrito'] ?? [];
            echo json_encode(['success' => true, 'carrito' => $cart]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // Vaciar carrito
    public function clearCart() {
        try {
            session_start();
            unset($_SESSION['carrito']);
            echo json_encode(['success' => true, 'message' => 'Carrito vaciado']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
