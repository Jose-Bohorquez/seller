
<body>
  <?php
// Función para obtener el total del carrito
if (!function_exists('obtenerTotalCarrito')) {
    function obtenerTotalCarrito() {
        $total = 0;
        if (isset($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $producto) {
                $total += $producto['precio'] * $producto['cantidad'];
            }
        }
        return $total;
    }
}
// Función para obtener los productos en el carrito
if (!function_exists('obtenerProductosCarrito')) {
    function obtenerProductosCarrito() {
        return isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
    }
}
?>
  <div class="container-fluid">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="border-radius: 0 0 8px 8px ;">
      <div class="container">
        <a class="navbar-brand text-white fw-bold" href="#">LOGO</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link text-white" href="?c=Landing&a=mainv2">Inicio</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">Categorías</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Celulares</a></li>
                <li><a class="dropdown-item" href="#">Computadores</a></li>
                <li><a class="dropdown-item" href="#">Equipos Usados</a></li>
                <li><a class="dropdown-item" href="#">(En Desarrollo)</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#">Contacto</a>
            </li>
          </ul>
          <div class="input-group">
            <input class="form-control" type="search" placeholder="Buscar producto..." aria-label="Search">
            <span class="input-group-text">
              <i class="fa-solid fa-magnifying-glass"></i>
            </span>
          </div>
          <?php
session_start();
// Verificar si la sesión está activa
if (isset($_SESSION['user'])) {
    // Usuario autenticado: Mostrar botones de "Cerrar Sesión" y "Perfil"
    ?>
          <div class="d-flex align-items-center ms-4">
            <a href="?c=Userv&a=profile" class="btn btn-light me-2 text-nowrap px-3">Mi Perfil</a>
            <a href="?c=Log_out&a=main" class="btn btn-danger px-3 text-nowrap">Cerrar Sesión</a>
            <!-- <a href="#" class="text-white ms-3 fs-4"><i class="fa-solid fa-cart-shopping"></i></a> -->
          </div>
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <!-- Icono del carrito con contador -->
            <li class="nav-item d-flex align-items-center">
              <button type="button" class="btn position-relative p-0 border-0" data-bs-toggle="modal"
                data-bs-target="#modalCarrito" style="background-color: transparent;">
                <i class="fa-solid fa-cart-shopping fs-3 text-white"></i> <!-- Agregado text-white para color blanco -->
                <span id="cart-count"
                  class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  0
                  <span class="visually-hidden">productos en el carrito</span>
                </span>
              </button>
            </li>
          </ul>
          <?php
} else {
    // Usuario no autenticado: Mostrar botones de "Iniciar Sesión" y "Registrarse"
    ?>
          <div class="d-flex align-items-center ms-4">
            <a href="?c=Login&a=main" class="btn btn-session text-white me-2 text-nowrap px-3">Iniciar Sesión</a>
            <a href="?c=Registry" class="btn btn-register bg-white px-3">Registrarse</a>
            <!-- <a href="#" class="text-white ms-3 fs-4"><i class="fa-solid fa-cart-shopping"></i></a> -->
          </div>
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <!-- Icono del carrito con contador -->
            <li class="nav-item d-flex align-items-center">
              <button type="button" class="btn position-relative p-0 border-0" data-bs-toggle="modal"
                data-bs-target="#modalCarrito" style="background-color: transparent;">
                <i class="fa-solid fa-cart-shopping fs-3 text-white"></i> <!-- Agregado text-white para color blanco -->
                <span id="cart-count"
                  class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  0
                  <span class="visually-hidden">productos en el carrito</span>
                </span>
              </button>
            </li>
          </ul>
          <?php
}
?>
        </div>
      </div>
    </nav>