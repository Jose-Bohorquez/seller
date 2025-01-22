<?php
require_once "models/User.php";

class Login
{
    public function main()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            require_once "views/login/login.view.php";
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['correo'];
            $password = sha1($_POST['passCorreo']);

            $user = new User();
            $authenticatedUser = $user->get_user_by_email_and_password($email, $password);

            if ($authenticatedUser) {
                $_SESSION['user'] = [
                    'id' => $authenticatedUser->get_id_user(),
                    'name' => $authenticatedUser->get_name_user(),
                    'lastname' => $authenticatedUser->get_lastname(), // Asegúrate de que este valor exista.
                    'role' => $authenticatedUser->get_rol(),
                ];
                

                // Redirigir según el rol
                $rolesRedirects = [
                    1 => "?c=Dashboard&a=main", // Super Admin
                    2 => "?c=Dashboard&a=main", // Admin
                    3 => "?c=Sellerv&a=dashboard", // Seller
                    4 => "?c=Landing&a=main&m=loginOk", // User
                ];

                $redirect = $rolesRedirects[$authenticatedUser->get_rol()] ?? "?c=Login&a=main";
                header("Location: $redirect");
                exit();
            } else {
                header("Location: ?c=Login&a=main&error=invalid_credentials");
                exit();
            }
        }
    }
}
?>
