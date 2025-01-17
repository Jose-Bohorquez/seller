<!-- Nav lateral -->
<section class="full-box nav-lateral">
	<div class="full-box nav-lateral-bg show-nav-lateral"></div>
	<div class="full-box nav-lateral-content">
		<figure class="full-box nav-lateral-avatar">
			<i class="far fa-times-circle show-nav-lateral"></i>
			<img src="assets/plantilla/dashboard/assets/avatar/Avatar.png" class="img-fluid" alt="Avatar">
			<figcaption class="roboto-medium text-center">

				<?php /*
// Comprobamos si la sesión está activa y si la información necesaria está completa
if (isset($_SESSION['sesion_status']) && $_SESSION['sesion_status'] === 'ok') {
    // Verificamos que los datos necesarios existan
    if (isset($_SESSION['name']) && isset($_SESSION['lastname']) && isset($_SESSION['rol'])) {
        // Verificar que el rol sea el adecuado para acceder a la vista
        if ($_SESSION['rol'] === 1 || $_SESSION['rol'] === 1) {
            // Si el rol es admin o superadmin, mostramos el dashboard
            echo "Bienvenido, " . $_SESSION['name'] . " " . $_SESSION['lastname'];
            // Aquí iría el contenido del dashboard o la vista protegida
        } else {
            // Si el rol no es admin o superadmin, no permitimos el acceso
            echo "No tienes permisos para acceder a esta página.";
        }
    } else {
        // Si falta alguno de los datos necesarios (name, lastname, rol), redirigimos o mostramos un error
        echo "Sesión incompleta. Por favor, vuelve a iniciar sesión.";
        // Podrías redirigir al usuario a la página de login
        // header('Location: login.php');
        // exit();
    }
} else {
    // Si no hay sesión activa o no está correctamente iniciada, redirigimos o mostramos un mensaje de error
    echo "Por favor, inicia sesión para acceder a esta página.";
    // Puedes redirigir al usuario al login también
    // header('Location: login.php');
    // exit();
}*/
?>


<?php
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $userName = $user['name'];
    $userLastname = $user['lastname'];
    $userRol = $user['role']; // Cambiado de 'rol' a 'role'
    $roleName = '';

    // Convertir ID del rol a nombre descriptivo
    switch ($userRol) {
        case 1:
            $roleName = 'Super Admin';
            break;
        case 2:
            $roleName = 'Admin';
            break;
        case 3:
            $roleName = 'Seller';
            break;
        case 4:
            $roleName = 'User';
            break;
        default:
            $roleName = 'Desconocido';
    }
} else {
    header("Location: ?c=Login");
    exit;
}

?>


				<br>
<small class="roboto-condensed-light">
    <?php echo htmlspecialchars($userName . ' ' . $userLastname, ENT_QUOTES, 'UTF-8'); ?>
</small>
<br>
<small class="roboto-condensed-light">
    <?php echo htmlspecialchars($roleName, ENT_QUOTES, 'UTF-8'); ?>
</small>

			</figcaption>
		</figure>
		<div class="full-box nav-lateral-bar"></div>
		<nav class="full-box nav-lateral-menu">
			<ul>
				<li>
					<a href="?c=Dashboard&a=main"><i class="fab fa-dashcube fa-fw"></i> &nbsp; Dashboard</a>
				</li>

				<li>
					<a href="#" class="nav-btn-submenu"><i class="fas  fa-user-secret fa-fw"></i> &nbsp; Roles <i
							class="fas fa-chevron-down"></i></a>
					<ul>
						<li>
							<a href="?c=Roles&a=create_rol"><i class="fas fa-plus fa-fw"></i> &nbsp; Nuevo Rol</a>
						</li>
						<li>
							<a href="?c=Roles&a=read_rol"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de
								Roles</a>
						</li>
					</ul>
				</li>

				<li>
					<a href="#" class="nav-btn-submenu"><i class="fas fa-users fa-fw"></i> &nbsp; Usuarios <i
							class="fas fa-chevron-down"></i></a>
					<ul>
						<li>
							<a href="?c=Users&a=create_user"><i class="fas fa-plus fa-fw"></i> &nbsp; Nuevo
								usuario</a>
						</li>
						<li>
							<a href="?c=Users&a=read_user"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de
								usuarios</a>
						</li>
					</ul>
				</li>

				<li>
					<a href="#" class="nav-btn-submenu"><i class="fas fa-pallet fa-fw"></i> &nbsp; Productos <i
							class="fas fa-chevron-down"></i></a>
					<ul>
						<li>
							<a href="?c=Products&a=create_product"><i class="fas fa-plus fa-fw"></i> &nbsp; Agregar
								producto</a>
						</li>
						<li>
							<a href="?c=Products&a=read_products"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de
								productos</a>
						</li>
					</ul>
				</li>

				<li>
					<a href="#" class="nav-btn-submenu"><i class="fas fa-plus fa-fw fa-tags"></i></i> &nbsp;
						Ofertas <i class="fas fa-chevron-down"></i></a>
					<ul>
						<li>
							<a href="?c=Offerts&a=create_offer"><i class="fas fa-plus fa-fw"></i> &nbsp; Nuevo Oferta</a>
						</li>
						<li>
							<a href="?c=Offerts&a=read_offer"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de
								Ofertas</a>
						</li>
					</ul>
				</li>

			</ul>
		</nav>
	</div>
</section>