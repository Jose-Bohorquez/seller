<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Perfil usuario</title>

    <!-- Normalize V8.0.1 -->
    <link rel="stylesheet" href="assets/plantilla/dashboard/css/normalize.css">

    <!-- Bootstrap V4.3 -->
    <link rel="stylesheet" href="assets/plantilla/dashboard/css/bootstrap.min.css">

    <!-- Bootstrap Material Design V4.0 -->
    <link rel="stylesheet" href="assets/plantilla/dashboard/css/bootstrap-material-design.min.css">

    <!-- Font Awesome V5.9.0 -->
    <link rel="stylesheet" href="assets/plantilla/dashboard/css/all.css">

    <!-- Sweet Alerts V8.13.0 CSS file -->
    <link rel="stylesheet" href="assets/plantilla/dashboard/css/sweetalert2.min.css">

    <!-- Sweet Alert V8.13.0 JS file-->
    <script src="assets/plantilla/dashboard/js/sweetalert2.min.js"></script>

    <!-- jQuery Custom Content Scroller V3.1.5 -->
    <link rel="stylesheet" href="assets/plantilla/dashboard/css/jquery.mCustomScrollbar.css">

    <!-- General Styles -->
    <link rel="stylesheet" href="assets/plantilla/dashboard/css/style.css">


</head>

<body>

    <!-- Main container -->
    <main class="full-box main-container">


        <!-- Nav lateral -->
        <section class="full-box nav-lateral">
            <div class="full-box nav-lateral-bg show-nav-lateral"></div>
            <div class="full-box nav-lateral-content">
                <figure class="full-box nav-lateral-avatar">
                    <i class="far fa-times-circle show-nav-lateral"></i>
                    <img src="assets/plantilla/dashboard/assets/avatar/Avatar.png" class="img-fluid" alt="Avatar">
                    <figcaption class="roboto-medium text-center">

                    <?php
session_start(); // Inicia o reanuda la sesión

if (isset($_SESSION['user'])) { // Verifica si existe la sesión
    $name = $_SESSION['user']['name'] ?? 'Nombre no disponible'; // Obtén el nombre
    $roleNumber = $_SESSION['user']['role'] ?? null; // Obtén el rol numérico

    // Determina el rol en texto según el valor numérico
    $roleText = 'Rol desconocido'; // Valor por defecto
    switch ($roleNumber) {
        case 1:
            $roleText = 'Super Admin';
            break;
        case 2:
            $roleText = 'Admin';
            break;
        case 3:
            $roleText = 'Seller';
            break;
        case 4:
            $roleText = 'Usuario';
            break;
    }
    ?>
    <p>
        <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?> <br>
        <small class="roboto-condensed-light">
            <?php echo htmlspecialchars($roleText, ENT_QUOTES, 'UTF-8'); ?>
        </small>
    </p>
    <?php
} else {
    // Si no hay sesión activa
    echo "<p>No hay sesión activa. Por favor, inicia sesión.</p>";
}
?>


                    </figcaption>
                </figure>
                <div class="full-box nav-lateral-bar"></div>
                <nav class="full-box nav-lateral-menu">
                    <ul>
                        <li>
                            <a href="?c=Userv&a=profile"><i class="fab fa-dashcube fa-fw"></i> &nbsp; Perfil</a>
                        </li>
                        <li>
                            <a href="?c=Userv&a=profile"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Mis Compras</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </section>




        <!-- Page content -->
        <section class="full-box page-content">
            <nav class="full-box navbar-info">
                <a href="#" class="float-left show-nav-lateral">
                    <i class="fas fa-exchange-alt"></i>
                </a>
                <a href="?c=Log_out&a=main" class="btn-exit-system">
                    <i class="fas fa-power-off"></i>
                </a>
            </nav>

            <!-- Page header -->
            <div class="full-box page-header">
                <h3 class="text-left">
                    <i class="fab fa-dashcube fa-fw"></i> &nbsp; PERFIL DE USUARIO
                </h3>
                <!-- <p class="text-justify">
                    este dashboard mostrara accesos rapidos a todas las funcionalidades del usuario
                </p> -->
            </div>



            <div class="container-fluid">
    <form action="?c=Users&a=update_user" method="POST" class="form-neon">
        <fieldset>
            <legend><i class="fas fa-user"></i> &nbsp; Información de perfil</legend>
            <div class="container-fluid">
                <div class="row">
                    <!-- Campo oculto para el ID del usuario -->
                    <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($userData->get_id_user()); ?>">

                    <!-- Campo Nombre -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="user_name" class="bmd-label-floating">Nombres</label>
                            <input value="<?php echo htmlspecialchars($userData->get_name_user()); ?>" name="user_name" type="text" class="form-control" id="user_name" maxlength="40" required>
                        </div>
                    </div>

                    <!-- Campo Apellido -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="user_lastname" class="bmd-label-floating">Apellidos</label>
                            <input value="<?php echo htmlspecialchars($userData->get_lastname()); ?>" name="user_lastname" type="text" class="form-control" id="user_lastname" maxlength="40" required>
                        </div>
                    </div>

                    <!-- Campo Documento -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="user_doc" class="bmd-label-floating">N° de documento</label>
                            <input value="<?php echo htmlspecialchars($userData->get_id_number()); ?>" name="user_doc" type="text" class="form-control" id="user_doc" maxlength="27" required>
                        </div>
                    </div>

                    <!-- Campo Teléfono -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="user_cel" class="bmd-label-floating">Teléfono</label>
                            <input value="<?php echo htmlspecialchars($userData->get_cel()); ?>" name="user_cel" type="text" class="form-control" id="user_cel" maxlength="20" required>
                        </div>
                    </div>

                    <!-- Campo Correo -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="user_email" class="bmd-label-floating">Correo</label>
                            <input value="<?php echo htmlspecialchars($userData->get_email()); ?>" name="user_email" type="email" class="form-control" id="user_email" maxlength="100" required>
                        </div>
                    </div>

                    <!-- Campo Contraseña -->
                    <!-- <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="user_pass" class="bmd-label-floating">Contraseña</label>
                            <input name="user_pass" type="password" class="form-control" id="user_pass" maxlength="150">
                            <small class="form-text text-muted">Deje este campo vacío si no desea cambiar la contraseña.</small>
                        </div>
                    </div> -->

                    <!-- Campo Rol -->
                    <!-- <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="user_rol" class="bmd-label-floating">Rol</label>
                            <select name="user_rol" class="form-control" id="user_rol">
                                <option value="">Seleccione un rol</option>
                                <?php #foreach ($roles as $rol): ?>
                                    <option value="<?php #echo htmlspecialchars($rol->get_id_rol()); ?>" <?php #echo $userData->get_rol() == $rol->get_id_rol() ? 'selected' : ''; ?>>
                                        <?php #echo htmlspecialchars($rol->get_name_rol()); ?>
                                    </option>
                                <?php #endforeach; ?>
                            </select>
                        </div>
                    </div> -->
                </div>
            </div>
        </fieldset>
        <!-- <p class="text-center">
            <button type="reset" class="btn btn-raised btn-secondary btn-sm">
                <i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR / BORRAR
            </button>
            &nbsp;&nbsp;
            <button type="submit" class="btn btn-raised btn-info btn-sm">
                <i class="far fa-save"></i> &nbsp; ACTUALIZAR USUARIO
            </button>
        </p> -->
    </form>
</div>




        </section>
    </main>


    <!--=============================================
    =            Include JavaScript files           =
    ==============================================-->
    <!-- jQuery V3.4.1 -->
    <script src="assets/plantilla/dashboard/js/jquery-3.4.1.min.js"></script>

    <!-- popper -->
    <script src="assets/plantilla/dashboard/js/popper.min.js"></script>

    <!-- Bootstrap V4.3 -->
    <script src="assets/plantilla/dashboard/js/bootstrap.min.js"></script>

    <!-- jQuery Custom Content Scroller V3.1.5 -->
    <script src="assets/plantilla/dashboard/js/jquery.mCustomScrollbar.concat.min.js"></script>

    <!-- Bootstrap Material Design V4.0 -->
    <script src="assets/plantilla/dashboard/js/bootstrap-material-design.min.js"></script>
    <script>
        $(document).ready(function () {
            $('body').bootstrapMaterialDesign();
        });
    </script>

    <script src="assets/plantilla/dashboard/js/main.js"></script>
</body>

</html>