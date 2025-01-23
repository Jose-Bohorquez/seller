<?php

require_once "models/Product.php";

class CartController {
    private $productModel;

    public function __construct() {
        $this->productModel = new Product();
    }

    // Agregar producto al carrito
    public function addToCart() {
        session_start();
        $productId = $_POST['id'] ?? null;
        $quantity = $_POST['cantidad'] ?? 1;

        if (!$productId) {
            echo json_encode(['success' => false, 'message' => 'ID del producto no proporcionado']);
            return;
        }

        $product = $this->productModel->get_product_by_id($productId);

        if (!$product) {
            echo json_encode(['success' => false, 'message' => 'Producto no encontrado']);
            return;
        }

        $stockDisponible = $product->get_amount();
        if ($stockDisponible < $quantity) {
            echo json_encode(['success' => false, 'message' => 'Inventario insuficiente']);
            return;
        }

        // Descontar stock
        $this->productModel->update_amount($productId, $stockDisponible - $quantity);

        // Agregar al carrito
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        if (isset($_SESSION['carrito'][$productId])) {
            $_SESSION['carrito'][$productId]['cantidad'] += $quantity;
        } else {
            $_SESSION['carrito'][$productId] = [
                'id' => $productId,
                'nombre' => $product->get_name(),
                'precio' => $product->get_price(),
                'cantidad' => $quantity,
                'subtotal' => $product->get_price() * $quantity,
                'tiempo' => time()
            ];
        }

        echo json_encode(['success' => true, 'carrito' => $_SESSION['carrito']]);
    }

    // Mostrar carrito
    public function showCart() {
        session_start();
    
        $carrito = $_SESSION['carrito'] ?? [];
        
        // Valida que cada producto tenga precio y subtotal como números
        foreach ($carrito as $id => $producto) {
            $carrito[$id]['precio'] = (float) $producto['precio']; // Asegúrate de que sea un número
            $carrito[$id]['subtotal'] = (float) $producto['subtotal']; // Asegúrate de que sea un número
        }
    
        echo json_encode([
            'success' => true,
            'carrito' => $carrito
        ]);
    }
    

    // Vaciar carrito
    public function clearCart() {
        session_start();
        if (isset($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $productId => $producto) {
                $product = $this->productModel->get_product_by_id($productId);
                $newStock = $product->get_amount() + $producto['cantidad'];
                $this->productModel->update_amount($productId, $newStock);
            }
            unset($_SESSION['carrito']);
        }
        echo json_encode(['success' => true]);
    }

    // Restaurar productos al inventario si el tiempo ha expirado
    public function checkCartTimeout() {
        session_start();
        if (!isset($_SESSION['carrito'])) {
            return;
        }

        $currentTime = time();
        foreach ($_SESSION['carrito'] as $productId => $producto) {
            if (($currentTime - $producto['tiempo']) > 300) { // 5 minutos
                $product = $this->productModel->get_product_by_id($productId);
                $newStock = $product->get_amount() + $producto['cantidad'];
                $this->productModel->update_amount($productId, $newStock);
                unset($_SESSION['carrito'][$productId]);
            }
        }
    }
}
?>
