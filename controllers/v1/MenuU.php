<?php
    class menuU{
        public function __construct(){}
        public function main(){
            require_once "views/usuario/menuU/header.php";
            require_once "views/usuario/menuU/categori.php";
            require_once "views/usuario/menuU/footer.php";
        }

        public  function cerrarSecion(){
            session_start();
            session_destroy();
            header("Location: ?c=menu ");
        }
    }
?>