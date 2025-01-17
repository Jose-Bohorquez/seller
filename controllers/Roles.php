<?php

    
    require_once "models/Rol.php";

    
    class Roles 
    {

        public function __construct(){}
        
        public function create_rol()
        {
            require_once "views/dashboard/modules/1_header.php";
            require_once "views/dashboard/modules/2_nav_lat.php";
            require_once "views/dashboard/modules/3_nav_sup.php";
            require_once "views/dashboard/pages/new_rol.php";
            require_once "views/dashboard/modules/footer.php";


            if (isset($_POST['rol_name']) && !empty(trim($_POST['rol_name']))) {
            $rol = new Rol(
                null, 
                $_POST['rol_name']   
            );            
            
            $rol->rol_create();
            header("location:?c=Roles&a=read_rol");
            }
        } 

        public function read_rol() {
            $roles = new Rol;
            $roles = $roles -> rol_read();
            #var_dump($roles); 
            require_once "views/dashboard/modules/1_header.php";
            require_once "views/dashboard/modules/2_nav_lat.php";
            require_once "views/dashboard/modules/3_nav_sup.php";
            require_once "views/dashboard/pages/read_roles.php";
            require_once "views/dashboard/modules/footer.php";

        }

        
public function update_rol() {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        // Verificar si el parámetro 'id_rol' existe en la URL
        if (isset($_GET['id_rol'])) {
            $rol = new Rol();
            // Obtener el rol actual de la base de datos usando el id
            $rol = $rol->get_rol_by_id($_GET['id_rol']);
            
            // Cargar las vistas
            require_once "views/dashboard/modules/1_header.php";
            require_once "views/dashboard/modules/2_nav_lat.php";
            require_once "views/dashboard/modules/3_nav_sup.php";
            require_once "views/dashboard/pages/update_rol.php";
            require_once "views/dashboard/modules/footer.php";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Verificar si los datos necesarios están presentes
        if (isset($_POST['name_rol_up']) && !empty(trim($_POST['name_rol_up'])) && isset($_POST['id_rol'])) {
            
            // Crear un objeto Rol con los datos recibidos
            $rol = new Rol(
                $_POST['id_rol'],      // ID del rol
                $_POST['name_rol_up']  // Nombre del rol
            );
            
            // Actualizar el rol en la base de datos
            $rol->rol_update();
            
            // Redirigir a la página de listado de roles
            header("Location: ?c=Roles&a=read_rol");
        }
    }
}

        
        
        

        public function delete_rol(){
            $rol = new Rol;
            $rol = $rol -> rol_delete($_GET['id_rol']);
            header("location:?c=Roles&a=read_rol");
        }
    }

?>
