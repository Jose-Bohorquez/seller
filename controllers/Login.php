<?php 

    require_once "models/User.php";

    class Login
    {
        

        public function main()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                require_once("views/login/login.view.php");
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $email = $_POST['correo'];
                $password = sha1($_POST['passCorreo']); // Hash de la contraseña

                $user = new User();
                $authenticatedUser = $user->get_user_by_email_and_password($email, $password);

                if ($authenticatedUser) {
                    // Crear la sesión con los datos del usuario
                    $_SESSION['user'] = [
                        'id' => $authenticatedUser->get_id_user(),
                        'name' => $authenticatedUser->get_name_user(),
                        'lastname' => $authenticatedUser->get_lastname(),
                        'email' => $authenticatedUser->get_email(),
                        'role' => $authenticatedUser->get_rol(),
                    ];

                    // Redirigir según el rol
                    switch ($authenticatedUser->get_rol()) {
                        case 1: // Super-admin
                            header("Location: views/user/admi/super_admin.view.php");
                            break;
                        case 2: // Admin
                            header("Location: views/user/admi/admin.view.php");
                            break;
                        case 3: // Seller
                            header("Location: views/user/sell/seller.view.php");
                            break;
                        case 4: // User
                            header("Location: views/user/user/user.view.php");
                            break;
                        default:
                            header("Location: ?c=Login&m=loginFailed"); // Rol desconocido
                            break;
                    }
                } else {
                    header("Location: ?c=Login&m=loginFailed"); // Redirige si el login falla
                }
            }
        }



    }
?>