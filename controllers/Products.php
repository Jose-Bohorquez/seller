<?php 

require_once "models/Product.php";

require_once 'helpers/cart_helper.php';

class Products
{
    public function __construct(){}



    public function create_product()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            require_once "views/dashboard/modules/1_header.php";
            require_once "views/dashboard/modules/2_nav_lat.php";
            require_once "views/dashboard/modules/3_nav_sup.php";
            require_once "views/dashboard/pages/new_product.php";  
            require_once "views/dashboard/modules/footer.php";
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $image_path = $this->handle_image_upload();

            
            $product = new Product(
                null,
                $_POST['product_name'],
                $_POST['product_description'],
                $_POST['product_technical_description'],
                $_POST['product_price'],
                $_POST['product_amount'],
                $_POST['product_category'],
                $image_path 
            );

            
            $product->product_create();

            
            header("Location: ?c=Products&a=read_products");
        }
    }


    
    private function handle_image_upload() {
        if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
            $target_dir = 'assets/imagenes/products/';
            
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $image_extension = pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION);
            $image_name = uniqid('product_', true) . '.' . $image_extension;
            $target_file = $target_dir . $image_name;

            if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file)) {
                return $target_file;
            } else {
                return null;
            }
        }
        return null;
    }


    
    public function read_products()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $product = new Product; 
            $products = $product->products_read(); 
            require_once "views/dashboard/modules/1_header.php";
            require_once "views/dashboard/modules/2_nav_lat.php";
            require_once "views/dashboard/modules/3_nav_sup.php";
            require_once "views/dashboard/pages/read_products.php";  
            require_once "views/dashboard/modules/footer.php";
        }
    }


    

    public function update_product()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            
            $product = new Product();
            $product = $product->get_product_by_id($_GET['id']);
            
            require_once "views/dashboard/modules/1_header.php";
            require_once "views/dashboard/modules/2_nav_lat.php";
            require_once "views/dashboard/modules/3_nav_sup.php";
            require_once "views/dashboard/pages/update_product.php";
            require_once "views/dashboard/modules/footer.php";
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // Crear el objeto producto con los datos del formulario
            $product = new Product(
                $_POST['product_id'],
                $_POST['product_name'],
                $_POST['product_description'],
                $_POST['product_technical_description'],
                $_POST['product_price'],
                $_POST['product_amount'],
                $_POST['product_category'],
                $_POST['existing_image'] // Usar la imagen existente como valor predeterminado
            );

            // Comprobar si se sube una nueva imagen
            if ($_FILES['product_image']['name']) {
                // Si hay una nueva imagen, procesarla
                $image_path = $this->handle_image_upload();
                if ($image_path) {
                    $product->set_image($image_path);  
                }
            } else {
                // Si no se sube una nueva imagen, mantener la imagen existente
                $product->set_image($_POST['existing_image']);
            }

            // Actualizar el producto
            $product->update_product();

            // Redirigir a la lista de productos
            header("Location: ?c=Products&a=read_products");
        }
    }





    public function delete_product()
    {
        $product = new Product;
        $product -> product_delete($_GET['id']);
        header("Location: ?c=Products&a=read_products");
    }







public function manage_cart() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);

        switch ($data['action']) {
            case 'add_to_cart':
                $this->addToCart($data['id'], $data['cantidad']);
                break;

            case 'empty_cart':
                $this->emptyCart();
                break;

            case 'remove_one':
                $this->removeOneFromCart($data['id']);
                break;

            default:
                echo json_encode(['success' => false, 'message' => 'Acción no válida.']);
                break;
        }
    }
}

private function addToCart($id, $cantidad) {
    $productModel = new Product();
    $producto = $productModel->get_product_by_id($id);

    if ($producto) {
        if ($producto->get_amount() >= $cantidad) {
            agregarAlCarrito(
                $producto->get_id(),
                $cantidad,
                $producto->get_price(),
                $producto->get_name(),
                $producto->get_image()
            );

            $producto->update_amount($producto->get_id(), $producto->get_amount() - $cantidad);

            echo json_encode([
                'success' => true,
                'carrito' => $_SESSION['carrito'],
                'total' => obtenerTotalCarrito()
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Inventario insuficiente.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Producto no encontrado.']);
    }
}

private function emptyCart() {
    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $id => $producto) {
            restablecerCantidadProducto($id, $producto['cantidad']);
        }
        $_SESSION['carrito'] = [];
    }

    echo json_encode([
        'success' => true,
        'carrito' => [],
        'total' => 0
    ]);
}

private function removeOneFromCart($id) {
    if (isset($_SESSION['carrito'][$id])) {
        // Restablecer solo 1 unidad al inventario
        restablecerCantidadProducto($id, 1);

        // Reducir la cantidad en el carrito
        $_SESSION['carrito'][$id]['cantidad']--;

        // Si la cantidad llega a 0, eliminar el producto del carrito
        if ($_SESSION['carrito'][$id]['cantidad'] <= 0) {
            unset($_SESSION['carrito'][$id]);
        }
    }

    // Responder con el carrito actualizado
    echo json_encode([
        'success' => true,
        'carrito' => $_SESSION['carrito'],
        'total' => obtenerTotalCarrito()
    ]);
}










public function confirm_purchase() {
    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        $carrito = $_SESSION['carrito'];
        $orderModel = new Order();

        // Registrar la orden en la base de datos
        $orderId = $orderModel->create_order($carrito);

        if ($orderId) {
            // Vaciar el carrito
            $_SESSION['carrito'] = [];
            echo json_encode(['success' => true, 'message' => 'Compra realizada con éxito']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al procesar la compra']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'El carrito está vacío']);
    }
}




    
}
?>
