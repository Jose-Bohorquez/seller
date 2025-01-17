<?php
require_once('models/Product.php'); // Ajusta la ruta según la estructura de tu proyecto


function agregarAlCarrito($id, $cantidad, $precio, $nombre, $imagen) {
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Si el producto ya está en el carrito, incrementa la cantidad
    if (isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id]['cantidad'] += $cantidad;
    } else {
        // Si no está en el carrito, agrégalo
        $_SESSION['carrito'][$id] = [
            'cantidad' => $cantidad,
            'precio' => $precio,
            'nombre' => $nombre,
            'imagen' => $imagen,
            'timestamp' => time()
        ];
    }
}



// Eliminar producto del carrito
function eliminarDelCarrito($id) {
    if (isset($_SESSION['carrito'][$id])) {
        unset($_SESSION['carrito'][$id]);
    }
}

// Vaciar carrito
function vaciarCarrito() {
    $_SESSION['carrito'] = [];
}

// Obtener total del carrito
function obtenerTotalCarrito() {
    $total = 0;
    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }
    }
    return $total;
}

function verificarTimeoutCarrito() {
    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $id => $producto) {
            // Verificar si han pasado más de 10 minutos (600 segundos)
            if (time() - $producto['timestamp'] > 600) {
                // Regresar la cantidad al inventario
                restablecerCantidadProducto($id, $producto['cantidad']);
                // Eliminar el producto del carrito
                unset($_SESSION['carrito'][$id]);
            }
        }
    }
}




function restablecerCantidadProducto($id, $cantidad) {
    $product = new Product();
    $productoActual = $product->get_product_by_id($id);

    if ($productoActual) {
        $nuevoInventario = $productoActual->get_amount() + $cantidad;
        $product->update_amount($id, $nuevoInventario);
    }
}


?>
