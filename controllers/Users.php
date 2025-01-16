<?php 

	require_once "models/User.php";

	class Users
	{


		public function __construct(){}


		

public function create_user()
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        // Cargar la vista del formulario de creación de usuario
        require_once "models/Rol.php";

        // Obtener roles para mostrar en la vista, si es necesario
        $rol = new Rol();
        $roles = $rol->rol_read();

        require_once "views/dashboard/modules/1_header.php";
        require_once "views/dashboard/modules/2_nav_lat.php";
        require_once "views/dashboard/modules/3_nav_sup.php";
        require_once "views/dashboard/pages/new_user.php"; // Vista para crear usuario
        require_once "views/dashboard/modules/footer.php";
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Validar y procesar los datos
        $allowedDomains = ['@servitel.cc', '@servientrega.co', '@global.com'];
        $email = trim($_POST['user_email']);
        $selectedDomain = trim($_POST['user_domain']);

        // Validar dominio
        if (!in_array($selectedDomain, $allowedDomains)) {
            header("Location: ?c=Users&a=create_user&m=invalidDomain");
            exit;
        }

        $fullEmail = $email . $selectedDomain;

        // Crear objeto User con rol fijo (4 = Usuario)
        $user = new User(
            null,
            trim($_POST['user_name']),
            trim($_POST['user_lastname']),
            trim($_POST['user_doc']),
            trim($_POST['user_cel']),
            $fullEmail,
            sha1(trim($_POST['user_pass'])), // Contraseña cifrada
            4 // Rol fijo para usuarios normales
        );

        // Intentar guardar el usuario en la base de datos
        try {
            $user->user_create();
            header("Location: ?c=Users&a=read_user&m=success"); // Redirigir a la lista de usuarios
        } catch (Exception $e) {
            header("Location: ?c=Users&a=create_user&m=error"); // Redirigir en caso de error
        }
    }
}







		public function read_user()
		{
			if ($_SERVER['REQUEST_METHOD'] == 'GET') {
				$user = new User;
				$users_all = $user -> user_read();
				#var_dump($users_all);  // Esto debería mostrar un array con los objetos de tipo Rol
		    	#echo '<pre>'; print_r($users_all); echo '</pre>';
				require_once "views/dashboard/modules/1_header.php";
				require_once "views/dashboard/modules/2_nav_lat.php";
				require_once "views/dashboard/modules/3_nav_sup.php";
				require_once "views/dashboard/pages/read_user.php";
				require_once "views/dashboard/modules/footer.php";
			}
		}








public function update_user()
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        try {
            // Cargar el usuario
            $user = new User();
            $user = $user->get_user_by_id($_GET['id_user']);

            // Cargar los roles
            require_once "models/Rol.php";
            $rol = new Rol();
            $roles = $rol->rol_read(); // Esto obtiene los roles de la tabla `rol`
        } catch (Exception $e) {
            die("Error al obtener datos: " . $e->getMessage());
        }

        // Cargar la vista con los datos
        require_once "views/dashboard/modules/1_header.php";
        require_once "views/dashboard/modules/2_nav_lat.php";
        require_once "views/dashboard/modules/3_nav_sup.php";
        require_once "views/dashboard/pages/update_user.php";
        require_once "views/dashboard/modules/footer.php";
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            $currentUser = new User();
            $currentUser = $currentUser->get_user_by_id($_POST['id_user']);

            $newRole = trim($_POST['user_rol']);
            $roleToSave = !empty($newRole) && $newRole != $currentUser->get_rol()
                ? $newRole
                : $currentUser->get_rol();

            $user = new User(
                $_POST['id_user'],
                $_POST['user_name'],
                $_POST['user_lastname'],
                $_POST['user_doc'],
                $_POST['user_cel'],
                $_POST['user_email'],
                !empty(trim($_POST['user_pass'])) ? sha1(trim($_POST['user_pass'])) : $currentUser->get_pass(),
                $roleToSave
            );

            $user->user_update();
            header("Location: ?c=Users&a=read_user&m=success");
        } catch (Exception $e) {
            die("Error al actualizar el usuario: " . $e->getMessage());
        }
    }
}








		public function delete_user()
		{

			$user = new User;
			$user -> user_delete($_GET['id_user']);
			header("Location: ?c=Users&a=read_user");

		}


		


	}

 ?>