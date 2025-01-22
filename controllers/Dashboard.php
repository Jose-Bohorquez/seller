<?php

    class Dashboard
    {



        public function main()
        {
            if (!isset($_SESSION['user']) || $_SESSION['user']['role'] > 2) {
                header("Location: ?c=Login&a=main");
                exit();
            }

            require_once "views/dashboard/modules/1_header.php";
            require_once "views/dashboard/modules/2_nav_lat.php";
            require_once "views/dashboard/modules/3_nav_sup.php";
            require_once "views/dashboard/modules/4_contenido.php";
            require_once "views/dashboard/modules/footer.php";
        }



    }
    

?>
