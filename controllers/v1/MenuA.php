<?php
    class menuA{
        
        public function __construct(){}

        public function main(){
            
            #require_once "views/administrador/menu/header.php";
            // require_once "views/administrador/menu/categori.php";
            #require_once "views/administrador/menu/footer.php";

            require_once "views/dashboard/modules/1_header.view.php";
            require_once "views/dashboard/modules/2_nav_lat.php";
            require_once "views/dashboard/modules/3_nav_sup.php";
            require_once "views/dashboard/modules/4_info_page.php";
            require_once "views/dashboard/modules/contenido.php";
            require_once "views/dashboard/modules/footer.php";

        }

        public function log_out() {
            // Asegurarse de iniciar la sesión solo si no está ya iniciada
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Limpiar todas las variables de sesión
            $_SESSION = [];

            // Si se desea destruir la sesión completamente, eliminar la cookie de sesión
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

            // Redirigir al usuario a la página de destino
            header("Location: ?c=Landing");
            exit; // Importante para detener cualquier ejecución posterior
        }

    }
?>