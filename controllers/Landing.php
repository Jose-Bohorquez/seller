<?php 

class Landing
{
    // public function mainv2()
    // {
    //     require_once "models/Product.php";        
    //     $product = new Product;

    //     // Obtener productos por categoría
    //     $category1_products = $product->products_by_category(1); 
    //     $category2_products = $product->products_by_category(2); 
    //     $category3_products = $product->products_by_category(3);

    //     // Inicializar el array de imágenes
    //     $images = [];

    //     // Función para agregar productos aleatorios a la lista de imágenes
    //     function add_random_images($category_products, &$images, $num_images_to_add) {
    //         if (count($category_products) > 0 && $num_images_to_add > 0) {
    //             // Seleccionar aleatoriamente productos de esta categoría
    //             $random_products = array_rand($category_products, min($num_images_to_add, count($category_products)));
    //             if (is_array($random_products)) {
    //                 foreach ($random_products as $index) {
    //                     $images[] = $category_products[$index]->get_image();
    //                 }
    //             } else {
    //                 $images[] = $category_products[$random_products]->get_image();
    //             }
    //         }
    //     }

    //     // Prioridad: Mostrar al menos 2 productos por categoría si están disponibles
    //     add_random_images($category1_products, $images, 2); // Intentar con 2 de la categoría 1
    //     add_random_images($category2_products, $images, 2); // Intentar con 2 de la categoría 2
    //     add_random_images($category3_products, $images, 2); // Intentar con 2 de la categoría 3

    //     // Si no tenemos 6 imágenes, completar con productos de las categorías restantes
    //     if (count($images) < 6) {
    //         // Calcular cuántas imágenes faltan
    //         $remaining_needed = 6 - count($images);

    //         // Intentamos completar con productos de las categorías restantes
    //         add_random_images($category1_products, $images, $remaining_needed);
    //         add_random_images($category2_products, $images, $remaining_needed);
    //         add_random_images($category3_products, $images, $remaining_needed);
    //     }

    //     // Asegurarse de que no haya más de 6 imágenes
    //     $random_images = array_slice($images, 0, 6);

    //     // Pasar todos los productos a la vista
    //     require_once "views/landing/modules/header_v23.php";

    //     // Añadimos las variables de productos para las vistas
    //     #require_once "views/landing/landing_view.php";
    // }



    public function main()
    {
        // Importa el modelo de productos
        require_once "models/Product.php";
    
        // Instancia del modelo y obtiene los productos
        $productModel = new Product();
        $products = $productModel->products_read();
    
        // Pasa los productos a la vista
        require_once "views/landing/new_view.php";
    }





    public function checkout()
    {
        session_start();

        // Verificar que el carrito no esté vacío
        if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
            header('Location: index.php?c=Landing&a=main');
            exit;
        }

        // Pasar datos del carrito y usuario a la vista
        $carrito = $_SESSION['carrito'];
        $usuario = $_SESSION['user'] ?? [];

        // Cargar la vista del checkout
        #require_once "views/landing/modulesv2/1_head.php";
        require_once "views/checkout/checkout.view.php";
        #require_once "views/landing/modulesv2/7_footer.php";
    }
    
    




}


 ?>