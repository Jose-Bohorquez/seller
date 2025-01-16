<?php

ob_start();
session_start();

try {
    // Cargar la conexión con la base de datos
    require_once "models/Database.php";

    // Helpers
    require_once "helpers/cart_helper.php";
    require_once "helpers/auth_helper.php"; // Para la gestión de autenticación

    // Configuración por defecto
    $defaultController = "Landing";
    $defaultAction = "main";

    // Obtener controlador y acción desde la URL
    $controllerName = isset($_REQUEST['c']) ? ucfirst(strtolower($_REQUEST['c'])) : $defaultController;
    $actionName = isset($_REQUEST['a']) ? $_REQUEST['a'] : $defaultAction;

    // Rutas protegidas (solo accesibles para usuarios autenticados)
    #$protectedRoutes = ['Dashboard', 'Users', 'Products'];

    // Verificar si la ruta es protegida y si el usuario está autenticado
    #if (in_array($controllerName, $protectedRoutes) && !is_logged_in()) {
        #header("Location: ?c=Login"); // Redirigir al login si no está autenticado
        #exit();
    #}

    // Construir ruta del archivo del controlador
    $controllerFile = "controllers/" . $controllerName . ".php";

    // Verificar si el archivo del controlador existe
    if (file_exists($controllerFile)) {
        require_once $controllerFile;

        // Verificar si la clase del controlador existe
        if (class_exists($controllerName)) {
            $controller = new $controllerName;

            // Verificar si el método existe en el controlador
            if (method_exists($controller, $actionName)) {
                verificarTimeoutCarrito(); // Verificar si hay productos expirados en el carrito

                // Llamar al método del controlador
                call_user_func(array($controller, $actionName));
            } else {
                throw new Exception("El método '$actionName' no existe en el controlador '$controllerName'.");
            }
        } else {
            throw new Exception("El controlador '$controllerName' no existe.");
        }
    } else {
        throw new Exception("El archivo del controlador '$controllerFile' no existe.");
    }
} catch (Exception $e) {
    // Manejo de errores
    echo "<h1>Error</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "<p><a href='?c=Landing&a=main'>Volver al inicio</a></p>";
} finally {
    // Finalizar el almacenamiento en búfer
    ob_end_flush();
}

?>