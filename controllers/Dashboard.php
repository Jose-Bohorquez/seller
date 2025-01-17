<?php 

class Dashboard
{
    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: ?c=Login"); // Redirige si no está autenticado
            exit();
        }
    }

    public function main()
    {
        require_once "views/dashboard/modules/1_header.php";
        require_once "views/dashboard/modules/2_nav_lat.php";
        require_once "views/dashboard/modules/3_nav_sup.php";
        require_once "views/dashboard/modules/4_info_page.php";
        require_once "views/dashboard/modules/5_contenido.php";
        require_once "views/dashboard/modules/footer.php";
    }
}
