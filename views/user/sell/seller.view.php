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
$roles = [
    1 => 'Super Admin',
    2 => 'Admin',
    3 => 'Seller',
    4 => 'User'
];
$roleName = $roles[$_SESSION['user']['role']] ?? 'Unknown Role';
?>

<!-- Mostrar el nombre completo y el rol -->
<?php echo $_SESSION['user']['name'] . ' ' . $_SESSION['user']['lastname']; ?> 
<br>
<small class="roboto-condensed-light">
    <?php echo $roleName; ?>
</small>



                    


                </figcaption>
                </figure>
                <div class="full-box nav-lateral-bar"></div>
                <nav class="full-box nav-lateral-menu">
                    <ul>
                        <li>
                            <a href="?c=Dashboard"><i class="fab fa-dashcube fa-fw"></i> &nbsp; Dashboard</a>
                        </li>

                        <li>
                            <a href="#" class="nav-btn-submenu"><i class="fas fa-user-tag fa-fw"></i> &nbsp; Roles <i
                                    class="fas fa-chevron-down"></i></a>
                            <ul>
                                <li>
                                    <a href="?c=Roles&a=create_rol"><i class="fas fa-plus fa-fw"></i> &nbsp; Crear
                                        Rol</a>
                                </li>
                                <li>
                                    <a href="?c=Roles&a=read_rol"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp;
                                        Lista de Roles</a>
                                </li>
                            </ul>
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
                    <i class="fab fa-dashcube fa-fw"></i> &nbsp; DASHBOARD
                </h3>
                <p class="text-justify">
                    este dashboard mostrara accesos rapidos a todas las funcionalidades
                </p>
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