<?php

    class Sellerv
    {

        
        public function __construct()
        {
            if (!isset($_SESSION['user'])) {
                header("Location: ?c=Login"); // Redirige si no está autenticado
                exit();
            }
        }

        

        public function dashboard()
        {
            // Cargar las vistas del dashboard para vendedores
            require_once "views/user/sell/seller.view.php";
        }
    }


?>