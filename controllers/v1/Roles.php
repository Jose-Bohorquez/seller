<?php 
require_once "models/users/rol.php";
require_once "models/users/user.php";



    class Roles{
        public function main(){
            header("Location:?c=menu");
          }
        public function mostrarFormularioRol(){

            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                require_once "views/rol/header.php";
                require_once "views/rol/encabezado.php";
            }

        }


    // Registrar Rol  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si se recibieron los datos necesarios del formulario
    public function createRolUsuario()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            #require_once "views/usuario/registro/header.php";
            #require_once "views/usuario/registro/footer.php";
            #require_once "views/usuario/registro/encabezado.php";
            require_once "views/registry/registry.view.php";
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Verificar si todos los datos necesarios están presentes
            if (isset($_POST['nombre'], $_POST['apellidos'], $_POST['correo'], $_POST['passCorreo'])) {
                $usuario = 'Usuario'; // Asigna el rol de usuario automáticamente
                $rol = new Rol(
                    $_POST['nombre'],
                    $_POST['apellidos'],
                    $_POST['correo'],
                    $_POST['passCorreo'],
                    $_POST['usuario'] = $usuario
                );
                // Mostrar datos recibidos para verificar 
                // print_r($_POST);
                // // Mostrar datos de la instancia de Rol para verificar
                // print_r($rol);
                // Intentar crear el rol en la base de datos
                try {
                    $rol->createRol();
                    header("Location: ?c=Roles&a=validate");
                } catch (Exception $e) {
                    echo "Error al crear el rol: " . $e->getMessage();
                }
            } else {
                echo "Por favor, complete todos los campos del formulario.";
            }
        }
    }

            public function createRolVendedor(){
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    require_once "views/vendedor/registroV/header.php";
                    require_once "views/vendedor/registroV/footer.php";
                    require_once "views/vendedor/registroV/encabezado.php";
                } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // Verificar si todos los datos necesarios están presentes
                    if (isset($_POST['nombre'], $_POST['apellidos'], $_POST['correo'], $_POST['passCorreo'])) {
                        $usuario = 'Vendedor'; // Asigna el rol de usuario automáticamente
                        $rol = new Rol(
                            $_POST['nombre'],
                            $_POST['apellidos'],
                            $_POST['correo'],
                            $_POST['passCorreo'],
                            $_POST['usuario'] = $usuario
                        );
                    // // Mostrar datos recibidos para verificar
                    // print_r($_POST);
                    // // Mostrar datos de la instancia de Rol para verificar
                    // print_r($rol);
                    // Intentar crear el rol en la base de datos
                    try {
                        $rol->createRol();
                         header("Location: ?c=Roles&a=validar");
                    } catch (Exception $e) {
                        echo "Error al crear el rol: " . $e->getMessage();
                    }
                } else {
                    echo "Por favor, complete todos los campos del formulario.";
                }
            }}



            public function createRolVendedorA(){
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    
                    #require_once "views/administrador/menu/header.php";
                    # require_once "views/administrador/menu/categori.php";
                    #require_once "views/administrador/menu/footer.php";
                    #require_once "views/vendedor/registroV/header.php";
                    #require_once "views/vendedor/registroV/footer.php";
                    #require_once "views/vendedor/registroV/encabezado.php";
                } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // Verificar si todos los datos necesarios están presentes
                    if (isset($_POST['nombre'], $_POST['apellidos'], $_POST['correo'], $_POST['passCorreo'])) {
                        $usuario = 'Vendedor'; // Asigna el rol de usuario automáticamente
                        $rol = new Rol(
                            $_POST['nombre'],
                            $_POST['apellidos'],
                            $_POST['correo'],
                            $_POST['passCorreo'],
                            $_POST['usuario'] = $usuario
                        );
                    // // Mostrar datos recibidos para verificar
                    // print_r($_POST);
                    // // Mostrar datos de la instancia de Rol para verificar
                    // print_r($rol);
                    // Intentar crear el rol en la base de datos
                    try {
                        $rol->createRol();
                         header("Location: ?c=Roles&a=validar");
                    } catch (Exception $e) {
                        echo "Error al crear el rol: " . $e->getMessage();
                    }
                } else {
                    echo "Por favor, complete todos los campos del formulario.";
                }
            }}





    public function validate()
    {
        // Si la solicitud es GET, simplemente cargamos la vista del formulario de inicio de sesión
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            require_once "views/login/login.view.php";  // Cargar la vista de login
        }

        // Si la solicitud es POST, intentamos validar el inicio de sesión
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require_once "models/users/rol.php"; // Incluye la clase que contiene la función validarRol

            $rol = new rol(); // Crea una instancia de la clase rol

            $correo = $_POST['correo']; // Obtén el correo electrónico enviado por POST
            $passCorreo = $_POST['passCorreo']; // Obtén la contraseña enviada por POST

            // Realiza la validación del rol
            $usuario = $rol->validarRol($correo, $passCorreo);

            if ($usuario) {
                // Si la validación es exitosa, se crea la sesión y se redirige al usuario
                session_start();

                // Guardamos todos los datos del usuario en la sesión
                $_SESSION['sesion_status'] = 'ok';  // estado de sesion usuario            
                $_SESSION['id_user'] = $usuario['id_user'];  // ID del usuario            
                $_SESSION['name'] = $usuario['name'];  // Nombre del usuario
                $_SESSION['lastname'] = $usuario['lastname'];  // apellido del usuario
                $_SESSION['id_number'] = $usuario['id_number'];  // Correo electrónico
                $_SESSION['cel'] = $usuario['cel'];  // Rol del usuario
                $_SESSION['email'] = $usuario['email'];
                $_SESSION['rol'] = $usuario['rol'];

                // var_dump($_SESSION);

                // Redirigir según el rol

                if ($_SESSION['rol'] == 3) {
                    header("Location: ?c=menuV");  // Redirigir a la vista de Vendedor
                }
                if ($_SESSION['rol'] == 2) {
                    header("Location: ?c=Landing&a=main");  // Redirigir a la vista de Usuario
                }
                if ($_SESSION['rol'] == 1) {
                    header("Location: ?c=MenuA&a=main");  // Redirigir a la vista de Admin
                }

            } else {
                // Si la validación falla, redirigimos a la página de login con mensaje de error
                header("Location: ?c=Roles&a=validate&m=loginFailed");
                exit();
            }
        }
    }



        
        
        public function createRolAdmin(){
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                require_once "views/administrador/registro/header.php";
                require_once "views/administrador/registro/footer.php";
                require_once "views/administrador/registro/encabezado.php";
            }
            
            
            if (isset($_POST['nombre'], $_POST['apellidos'], $_POST['correo'], $_POST['passCorreo'])) {
                $usuario = 'Admin'; // Asigna el rol de usuario automáticamente
                $rol = new Rol(
                    $_POST['nombre'],
                    $_POST['apellidos'],
                    $_POST['correo'],
                    $_POST['passCorreo'],
                    $_POST['usuario'] = $usuario
                );
            // // Mostrar datos recibidos para verificar
            // print_r($_POST);
            // // Mostrar datos de la instancia de Rol para verificar
            // print_r($rol);
            // Intentar crear el rol en la base de datos
            try {
                $rol->createRol();
                 header("Location: ?c=Roles&a=validar");
            } catch (Exception $e) {
                echo "Error al crear el rol: " . $e->getMessage();
            }
        }
    }
    public function createRolAdminA(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            
            require_once "views/administrador/menu/header.php";
            // require_once "views/administrador/menu/categori.php";
            require_once "views/administrador/menu/footer.php";
            require_once "views/administrador/registro/header.php";
            require_once "views/administrador/registro/footer.php";
            require_once "views/administrador/registro/encabezado.php";
        }
        
        
        if (isset($_POST['nombre'], $_POST['apellidos'], $_POST['correo'], $_POST['passCorreo'])) {
            $usuario = 'Admin'; // Asigna el rol de usuario automáticamente
            $rol = new Rol(
                $_POST['nombre'],
                $_POST['apellidos'],
                $_POST['correo'],
                $_POST['passCorreo'],
                $_POST['usuario'] = $usuario
            );
        // // Mostrar datos recibidos para verificar
        // print_r($_POST);
        // // Mostrar datos de la instancia de Rol para verificar
        // print_r($rol);
        // Intentar crear el rol en la base de datos
        try {
            $rol->createRol();
             header("Location: ?c=Roles&a=validar");
        } catch (Exception $e) {
            echo "Error al crear el rol: " . $e->getMessage();
        }
    }
}
    public function createProduct() {
        session_start();
        $errors = array(); // Array para almacenar errores
        
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            require_once "views/vendedor/menu/header.php";
            require_once "views/vendedor/menu/categori.php";
            require_once "views/vendedor/menu/footer.php";
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['nombreP'], $_POST['descripcion'], $_POST['precio'], $_POST['cantidad'], $_FILES['imagen']['name'])) {
                // Validar la imagen
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $extension = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
    
                if (!in_array($extension, $allowedExtensions)) {
                    $errors['imagen'] = 'La imagen debe tener una extensión válida.';
                }
    
                // Validaciones adicionales para otros campos requeridos
                if (empty($_POST['categoria'])) {
                    $errors['categoria'] = 'Por favor, selecciona una categoría.';
                }
    
                if (empty($_POST['nombreP']) || empty($_POST['descripcion']) || empty($_POST['precio']) || empty($_POST['cantidad'])) {
                    $errors['otros'] = 'Por favor, completa todos los campos necesarios.';
                }
    
                // Si no hay errores, procedemos con la subida de la imagen y la creación del producto
                if (empty($errors)) {
                    $imagenNombre = uniqid() . '.' . $extension; // Generar un nombre único para la imagen
                    $target_dir = "img/";
                    $target_file = $target_dir . basename($imagenNombre);
    
                    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
                        // Inicializar el objeto Rol con los datos
                        $rol = new Rol(
                            $_POST['nombreP'],
                            $_POST['descripcion'],
                            $_POST['precio'],
                            $_POST['cantidad'],
                            $_POST['categoria']
                        );
    
                        try {
                            // Llamar a createProductos y pasar la imagen como argumento
                            $rol->createProductos($imagenNombre);
                            echo '<p>Producto creado con éxito.</p>';
                            header("Location: ?c=menuV"); // Redirigir al controlador deseado
                        } catch (Exception $e) {
                            $errors['db'] = "Error al crear el producto: " . $e->getMessage();
                        }
                    } else {
                        $errors['imagen'] = 'Error al subir la imagen.';
                    }
                }
            } else {
                echo "Por favor, complete todos los campos del formulario.";
            }
        }
    
        // Mostrar errores si los hay
        if (!empty($errors)) {
            foreach ($errors as $key => $error) {
                echo "<p>Error ($key): $error</p>";
            }
        }
    }

    public function createProductA() {
        session_start();
        $errors = array(); // Array para almacenar errores
        
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            require_once "views/administrador/menu/header.php";
            require_once "views/vendedor/menu/categori.php";
            require_once "views/vendedor/menu/footer.php";
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['nombreP'], $_POST['descripcion'], $_POST['precio'], $_POST['cantidad'], $_FILES['imagen']['name'])) {
                // Validar la imagen
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $extension = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
    
                if (!in_array($extension, $allowedExtensions)) {
                    $errors['imagen'] = 'La imagen debe tener una extensión válida.';
                }
    
                // Validaciones adicionales para otros campos requeridos
                if (empty($_POST['categoria'])) {
                    $errors['categoria'] = 'Por favor, selecciona una categoría.';
                }
    
                if (empty($_POST['nombreP']) || empty($_POST['descripcion']) || empty($_POST['precio']) || empty($_POST['cantidad'])) {
                    $errors['otros'] = 'Por favor, completa todos los campos necesarios.';
                }
    
                // Si no hay errores, procedemos con la subida de la imagen y la creación del producto
                if (empty($errors)) {
                    $imagenNombre = uniqid() . '.' . $extension; // Generar un nombre único para la imagen
                    $target_dir = "img/";
                    $target_file = $target_dir . basename($imagenNombre);
    
                    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
                        // Inicializar el objeto Rol con los datos
                        $rol = new Rol(
                            $_POST['nombreP'],
                            $_POST['descripcion'],
                            $_POST['precio'],
                            $_POST['cantidad'],
                            $_POST['categoria']
                        );
    
                        try {
                            // Llamar a createProductos y pasar la imagen como argumento
                            $rol->createProductos($imagenNombre);
                            echo '<p>Producto creado con éxito.</p>';
                            header("Location: ?c=menuA"); // Redirigir al controlador deseado
                        } catch (Exception $e) {
                            $errors['db'] = "Error al crear el producto: " . $e->getMessage();
                        }
                    } else {
                        $errors['imagen'] = 'Error al subir la imagen.';
                    }
                }
            } else {
                echo "Por favor, complete todos los campos del formulario.";
            }
        }
    
        // Mostrar errores si los hay
        if (!empty($errors)) {
            foreach ($errors as $key => $error) {
                echo "<p>Error ($key): $error</p>";
            }
        }
    }
   
    
    
        
    

}


        
?>