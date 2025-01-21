<?php 

	require_once "models/User.php";

	class Users
	{


		public function __construct(){}


		

        public function create_user()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                try {
                    // Obtener roles
                    require_once "models/Rol.php";
                    $rol = new Rol();
                    $roles = $rol->rol_read();
        
                    // Mostrar la vista de creación
                    require_once "views/dashboard/modules/1_header.php";
                    require_once "views/dashboard/modules/2_nav_lat.php";
                    require_once "views/dashboard/modules/3_nav_sup.php";
                    require_once "views/dashboard/pages/new_user.php";
                    require_once "views/dashboard/modules/footer.php";
                } catch (Exception $e) {
                    die("Error al cargar la vista de creación: " . $e->getMessage());
                }
            }
        
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                print_r(R_POST);
                try {
                    // Validar datos
                    if (
                        empty($_POST['user_name']) ||
                        empty($_POST['user_lastname']) ||
                        empty($_POST['user_doc']) ||
                        empty($_POST['user_cel']) ||
                        empty($_POST['user_email']) ||
                        empty($_POST['user_pass']) ||
                        empty($_POST['user_rol'])
                    ) {
                        header("Location: ?c=Users&a=create_user&m=missingFields");
                        exit;
                    }
        
                    // Crear usuario
                    $user = new User(
                        null,
                        trim($_POST['user_name']),
                        trim($_POST['user_lastname']),
                        trim($_POST['user_doc']),
                        trim($_POST['user_cel']),
                        trim($_POST['user_email']),
                        sha1(trim($_POST['user_pass'])), // Contraseña cifrada
                        trim($_POST['user_rol'])
                    );
        
                    #print_r($user);

                    // Guardar en base de datos
                    $user->user_create();
                    header("Location: ?c=Users&a=read_user&m=success");
                } catch (Exception $e) {
                    header("Location: ?c=Users&a=create_user&m=error");
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
            // Obtener los datos del usuario
            $userModel = new User();
            $user = $userModel->get_user_by_id($_GET['id_user']);
            print_r($user);
            // Obtener los roles
            require_once "models/Rol.php";
            $rolModel = new Rol();
            $roles = $rolModel->rol_read();

            // Validar datos antes de enviarlos a la vista
            if (!$user) {
                die("El usuario no existe.");
            }
            if (empty($roles)) {
                die("No se encontraron roles disponibles.");
            }

            // Pasar los datos a la vista
            require_once "views/dashboard/modules/1_header.php";
            require_once "views/dashboard/modules/2_nav_lat.php";
            require_once "views/dashboard/modules/3_nav_sup.php";
            require_once "views/dashboard/pages/update_user.php";
            require_once "views/dashboard/modules/footer.php";
        } catch (Exception $e) {
            die("Error al obtener los datos: " . $e->getMessage());
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            // Obtener el usuario actual desde la base de datos
            $userModel = new User();
            $currentUser = $userModel->get_user_by_id($_POST['id_user']);

            if (!$currentUser) {
                die("El usuario no existe.");
            }

            // Procesar los datos enviados
            $newName = trim($_POST['user_name']);
            $newLastname = trim($_POST['user_lastname']);
            $newIdNumber = trim($_POST['user_doc']);
            $newCel = trim($_POST['user_cel']);
            $newEmail = trim($_POST['user_email']);
            $newPass = !empty($_POST['user_pass']) ? sha1(trim($_POST['user_pass'])) : $currentUser->get_pass();
            $newRole = !empty($_POST['user_rol']) ? $_POST['user_rol'] : $currentUser->get_rol();

            // Crear un array para guardar los campos que han cambiado
            $fieldsToUpdate = [];

            // Comparar cada campo
            if ($currentUser->get_name_user() !== $newName) {
                $fieldsToUpdate['name_user'] = $newName;
            }
            if ($currentUser->get_lastname() !== $newLastname) {
                $fieldsToUpdate['lastname'] = $newLastname;
            }
            if ($currentUser->get_id_number() !== $newIdNumber) {
                $fieldsToUpdate['id_number'] = $newIdNumber;
            }
            if ($currentUser->get_cel() !== $newCel) {
                $fieldsToUpdate['cel'] = $newCel;
            }
            if ($currentUser->get_email() !== $newEmail) {
                $fieldsToUpdate['email'] = $newEmail;
            }
            if ($currentUser->get_pass() !== $newPass) {
                $fieldsToUpdate['pass'] = $newPass;
            }
            if ($currentUser->get_rol() !== $newRole) {
                $fieldsToUpdate['rol'] = $newRole;
            }

            // Si hay cambios, actualizamos en la base de datos
            if (!empty($fieldsToUpdate)) {
                $userModel->update_user_fields($fieldsToUpdate, $_POST['id_user']);
            }

            header("Location: ?c=Users&a=read_user&m=success"); // Redirigir al listado de usuarios
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