<?php

ob_start();
session_start();

try {
    // Cargar la conexión con la base de datos
    require_once "models/DataBase.php";

    // Helpers
    require_once "helpers/cart_helper.php";
    require_once "helpers/auth_helper.php"; // Para la gestión de autenticación

    // Configuración por defecto
    $defaultController = "Landing";
    $defaultAction = "main";

    // Obtener controlador y acción desde la URL
    $controllerName = isset($_REQUEST['c']) ? ucfirst(strtolower($_REQUEST['c'])) : $defaultController;
    $actionName = isset($_REQUEST['a']) ? $_REQUEST['a'] : $defaultAction;

    // Rutas públicas (accesibles sin autenticación)
    $publicRoutes = [
        'Users' => ['register', 'store', 'create_user_register'], // Acciones públicas del controlador Users
        'Landing' => [], // Todas las acciones de Landing son públicas
        'Login' => [], // Todas las acciones de Login son públicas
    ];

    // Rutas protegidas (requieren autenticación y roles específicos)
    $protectedRoutes = [
        'Dashboard' => ['roles' => [1, 2]], // Super-admin y Admin
        'Users' => [
            'roles' => [1, 2], // Super-admin y Admin
            'actions' => [
                'create_user' => [1, 2], // Solo Admin y Super-admin pueden crear usuarios
                'read_user' => [1, 2], // Super-admin y Admin pueden leer usuarios
                'update_user' => [1], // Solo Super-admin puede actualizar usuarios
                'delete_user' => [1], // Solo Super-admin puede eliminar usuarios
                'perfil' => [4], // Solo los usuarios normales pueden ver su perfil
            ],
        ],
        'Products' => [
            'roles' => [1, 2, 3], // Super-admin, Admin, y Seller
            'actions' => [
                'create_product' => [1, 2, 3], // Todos los roles indicados pueden crear productos
                'edit_product' => [1, 2, 3], // Todos los roles indicados pueden editar productos
                'delete_product' => [1, 2], // Solo Super-admin y Admin pueden eliminar productos
            ],
        ],
    ];

    // Verificar si la ruta es pública
    if (!array_key_exists($controllerName, $publicRoutes) || 
        (!empty($publicRoutes[$controllerName]) && !in_array($actionName, $publicRoutes[$controllerName]))) {

        // Validar rutas protegidas
        if (array_key_exists($controllerName, $protectedRoutes)) {
            $controllerConfig = $protectedRoutes[$controllerName];
            $allowedRoles = $controllerConfig['roles'] ?? []; // Roles permitidos para el controlador
            $protectedActions = $controllerConfig['actions'] ?? []; // Acciones protegidas dentro del controlador

            // Verificar si el usuario está autenticado
            if (!is_logged_in()) {
                header("Location: ?c=Login"); // Redirigir al login si no está autenticado
                exit();
            }

            // Validar si el rol del usuario puede acceder al controlador
            if (!empty($allowedRoles) && !in_array($_SESSION['user']['role'], $allowedRoles)) {
                echo "<h1>Acceso denegado</h1>";
                echo "<p>No tienes permisos para acceder a este controlador.</p>";
                echo "<p><a href='?c=Landing&a=main'>Volver al inicio</a></p>";
                exit();
            }

            // Validar si la acción está protegida
            if (!empty($protectedActions) && array_key_exists($actionName, $protectedActions)) {
                $actionRoles = $protectedActions[$actionName];
                if (!in_array($_SESSION['user']['role'], $actionRoles)) {
                    echo "<h1>Acceso denegado</h1>";
                    echo "<p>No tienes permisos para realizar esta acción.</p>";
                    echo "<p><a href='?c=Landing&a=main'>Volver al inicio</a></p>";
                    exit();
                }
            }
        } else {
            echo "<h1>Acceso denegado</h1>";
            echo "<p>No tienes permisos para acceder a este controlador.</p>";
            echo "<p><a href='?c=Landing&a=main'>Volver al inicio</a></p>";
            exit();
        }
    }

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

// Configuración para mostrar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
