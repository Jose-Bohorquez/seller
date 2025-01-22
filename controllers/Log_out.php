<?php

class Log_out
{
    public function main()
    {
        // Verificar si hay una sesión activa
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Iniciar sesión si no está ya iniciada
        }

        // Eliminar todas las variables de sesión
        $_SESSION = [];

        // Destruir la cookie de sesión si existe
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // Destruir la sesión
        session_destroy();

        // Redirigir al usuario a la página principal
        header("Location: ?c=Landing");
        exit();
    }
}

?>