<?php 

class Log_out
{
    public function main()
    {
        // Iniciar sesión si no está ya iniciada
        session_start();

        // Eliminar todas las variables de sesión
        $_SESSION = array();

        // Si se desea destruir completamente la sesión, también se puede eliminar la cookie de sesión
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, 
                $params["path"], $params["domain"], 
                $params["secure"], $params["httponly"]
            );
        }

        // Destruir la sesión
        session_destroy();

        // Redirigir al usuario a la página de login
        header("Location: ?c=Landing");
        exit(); // Asegurarse de que no se ejecute ningún código después de la redirección
    }
}

?>
