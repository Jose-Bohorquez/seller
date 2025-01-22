<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    // Cargar la conexión con la base de datos
    require_once "models/DataBase.php";

    // Configuración por defecto
    $defaultController = "Landing";
    $defaultAction = "main";

    // Obtener controlador y acción desde la URL
    $controllerName = isset($_REQUEST['c']) ? ucfirst($_REQUEST['c']) : $defaultController;
    $actionName = isset($_REQUEST['a']) ? $_REQUEST['a'] : $defaultAction;

    // Verificar existencia del controlador
    $controllerFile = "controllers/" . $controllerName . ".php";
    if (!file_exists($controllerFile)) {
        throw new Exception("Controlador no encontrado.");
    }

    require_once $controllerFile;

    if (!class_exists($controllerName)) {
        throw new Exception("Clase del controlador no encontrada.");
    }

    $controller = new $controllerName;

    if (!method_exists($controller, $actionName)) {
        throw new Exception("Método no encontrado.");
    }

    // Ejecutar el controlador y la acción
    call_user_func([$controller, $actionName]);

} catch (Exception $e) {
    echo "<h1>Error</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "<p><a href='?c=Login&a=main'>Volver al login</a></p>";
} finally {
    ob_end_flush();
}
?>
