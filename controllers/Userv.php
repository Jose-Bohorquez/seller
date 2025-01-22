<?php

    class Userv
    {

        public function __construct()
        {
            if (!isset($_SESSION['user'])) {
                header("Location: ?c=Login"); // Redirige si no está autenticado
                exit();
            }
        }





        public function profile()
        {        
            $id_rol_sesion = (int) $_SESSION['user']['id']; // Convertir a entero explícitamente
            require_once("models/User.php");
            $user = new User();
            $userData = $user->get_user_by_id($id_rol_sesion);

            if ($userData) {
                #var_dump($userData); // Muestra los datos devueltos
                require_once("views/user/user/user.view.php");
            } else {
                echo "El método get_user_by_id no devolvió ningún resultado.";
            }
        }        

        
        

    }

    

?>