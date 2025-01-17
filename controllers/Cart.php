<?php 

class Cart {
    public function agregarAlCarrito($producto_id) {
        // Simulamos obtener el producto desde la base de datos o un array de productos disponibles
        $producto = $this->obtenerProductoPorId($producto_id);

        // Verificar si el carrito ya existe en la sesión
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        // Verificar si el producto ya está en el carrito
        if (isset($_SESSION['carrito'][$producto_id])) {
            $_SESSION['carrito'][$producto_id]['cantidad']++;
        } else {
            $_SESSION['carrito'][$producto_id] = [
                'id' => $producto['id'],
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'cantidad' => 1,
                'imagen' => $producto['imagen']
            ];
        }
    }

    public function obtenerTotalCarrito() {
        $total = 0;
        foreach ($_SESSION['carrito'] as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }
        return number_format($total, 2);  // Asegúrate de devolver el total con dos decimales
    }

    public function obtenerProductoPorId($producto_id) {
        // Simulamos obtener el producto, reemplázalo con tu lógica real de base de datos
        $productos = [
            1 => ['id' => 1, 'nombre' => 'Producto 1', 'precio' => 10.00, 'imagen' => 'producto1.jpg'],
            2 => ['id' => 2, 'nombre' => 'Producto 2', 'precio' => 15.00, 'imagen' => 'producto2.jpg']
        ];

        return isset($productos[$producto_id]) ? $productos[$producto_id] : null;
    }
}


 ?>