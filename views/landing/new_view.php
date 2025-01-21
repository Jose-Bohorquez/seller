<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7380e2e883.js" crossorigin="anonymous"></script>
    <style>
      /* Navbar */
      .navbar {
        background: linear-gradient(to right, #007bff, #00aaff);
      }
      .navbar .input-group {
        margin: auto;
        width: 50%;
        position: relative;
      }
      .navbar .form-control {
        border-radius: 50px;
        padding-right: 3rem;
      }
      .navbar .input-group-text {
        border-radius: 50%;
        position: absolute;
        right: 0.5rem;
        top: 50%;
        transform: translateY(-50%);
        background-color: transparent;
        border: none;
        color: #007bff;
        cursor: pointer;
      }
      .navbar .btn-session {
        background: linear-gradient(to right, #ff00ff, #ff77ff);
        border: none;
      }
      .navbar .btn-register {
        border: 1px solid #ff00ff;
        color: #ff00ff;
      }

      /* Promo Section */
      .promo-section img {
        object-fit: cover;
        /*border-radius: 8px;*/
      }
      .promo-section .row.g-0 {
        gap: 0;
      }

      /* Product Section */
      .product-section .card {
        border: none;
      }
      .product-section .card-img-top {
        height: 150px;
        object-fit: cover;
      }
      .product-section .card-body {
        padding: 0.5rem;
      }
      .product-section h5 {
        font-size: 0.9rem;
        margin-bottom: 0.3rem;
      }
      .product-section p {
        font-size: 0.8rem;
        margin-bottom: 0.3rem;
      }
    </style>
  </head>
  <body>

    <div class="container">
      
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="border-radius: 0 0 8px 8px ;">
      <div class="container">
        <a class="navbar-brand text-white fw-bold" href="#">LOGO</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link text-white" href="#">Inicio</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categoría</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Celulares</a></li>
                <li><a class="dropdown-item" href="#">Computadores</a></li>
                <li><a class="dropdown-item" href="#">Equipos Usados</a></li>
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
          <div class="d-flex align-items-center ms-4">
            <a href="#" class="btn btn-session text-white me-2">Iniciar Sesión</a>
            <a href="#" class="btn btn-register bg-white">Registrarse</a>
            <a href="#" class="text-white ms-3 fs-4"><i class="fa-solid fa-cart-shopping"></i></a>
          </div>
        </div>
      </div>
    </nav>

    <br>

<!-- Carousel Section -->
<div id="promoCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <a href="https://www.google.com" target="_blank">
        <img src="assets/imagenes/landing/new/mascotas.webp" class="d-block w-100 rounded" alt="Promo 1">
      </a>
    </div>
    <div class="carousel-item">
      <a href="https://www.google.com" target="_blank">
        <img src="assets/imagenes/landing/new/s1-1.png" class="d-block w-100 rounded" alt="Promo 2">
      </a>
    </div>
    <div class="carousel-item">
      <a href="https://www.google.com" target="_blank">
        <img src="assets/imagenes/landing/new/s1-2.png" class="d-block w-100 rounded" alt="Promo 3">
      </a>
    </div>
    <div class="carousel-item">
      <a href="https://www.google.com" target="_blank">
        <img src="assets/imagenes/landing/new/rc.webp" class="d-block w-100 rounded" alt="Promo 4">
      </a>
    </div>

  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>



    <!-- Promo Section -->
    <div class="container my-5 promo-section">
      <div class="row g-0">
        <div class="col-md-6">
          <a href="https://www.google.com" target="_blank">
            <img src="assets/imagenes/landing/new/s2-1.png" alt="Promo Left" class="w-100 h-100" style="border-radius: 8px 0 0 8px;">
          </a>
        </div>
        <div class="col-md-6">
          <div class="row g-0">
            <div class="col-12">
              <a href="https://www.google.com" target="_blank">
                <img src="assets/imagenes/landing/new/s2-2.png" alt="Promo Top Right" class="w-100 h-100" style="border-radius: 0 8px 0 0 ;">
              </a>
            </div>
            <div class="col-6">
              <a href="https://www.google.com" target="_blank">
                <img src="assets/imagenes/landing/new/s2-3.png" alt="Promo Bottom Left" class="w-100 h-100" style="border-radius: 0 0 0 0 ;">
              </a>
            </div>
            <div class="col-6">
              <a href="https://www.google.com" target="_blank">
                <img src="assets/imagenes/landing/new/s2-4.png" alt="Promo Bottom Right" class="w-100 h-100" style="border-radius: 0 0 8px 0 ;">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Product Section -->
    <div class="container my-5 product-section">
      <div class="d-flex align-items-center mb-4">
        <h2 class="text-start mb-0 position-relative">
          Estrena Celular con Descuentos al Piso
          <span style="position: absolute; bottom: -5px; left: 0; height: 4px; width: 100%; background-color: red;"></span>
        </h2>
      </div>
      <div class="row row-cols-2 row-cols-sm-3 row-cols-lg-6 g-3">
        <div class="col">
          <div class="card text-center">
            <img src="assets/imagenes/landing/new/1.webp" class="card-img-top" alt="Producto 1">
            <div class="card-body">
              <h5>Galaxy-a05s</h5>
              <p class="text-muted text-decoration-line-through">$550.000</p>
              <p class="text-primary fw-bold">$420.000</p>
              <a href="#" class="btn btn-primary btn-sm">Comprar</a>
            </div>
          </div>
        </div>
        <!-- Repite más productos aquí -->
        <div class="col">
          <div class="card text-center">
            <img src="assets/imagenes/landing/new/2.webp" class="card-img-top" alt="Producto 1">
            <div class="card-body">
              <h5>Galaxy-a05s</h5>
              <p class="text-muted text-decoration-line-through">$550.000</p>
              <p class="text-primary fw-bold">$420.000</p>
              <a href="#" class="btn btn-primary btn-sm">Comprar</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card text-center">
            <img src="assets/imagenes/landing/new/3.webp" class="card-img-top" alt="Producto 1">
            <div class="card-body">
              <h5>Galaxy-a05s</h5>
              <p class="text-muted text-decoration-line-through">$550.000</p>
              <p class="text-primary fw-bold">$420.000</p>
              <a href="#" class="btn btn-primary btn-sm">Comprar</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card text-center">
            <img src="assets/imagenes/landing/new/6.webp" class="card-img-top" alt="Producto 1">
            <div class="card-body">
              <h5>Galaxy-a05s</h5>
              <p class="text-muted text-decoration-line-through">$550.000</p>
              <p class="text-primary fw-bold">$420.000</p>
              <a href="#" class="btn btn-primary btn-sm">Comprar</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card text-center">
            <img src="assets/imagenes/landing/new/5.webp" class="card-img-top" alt="Producto 1">
            <div class="card-body">
              <h5>Galaxy-a05s</h5>
              <p class="text-muted text-decoration-line-through">$550.000</p>
              <p class="text-primary fw-bold">$420.000</p>
              <a href="#" class="btn btn-primary btn-sm">Comprar</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card text-center">
            <img src="assets/imagenes/landing/new/7.webp" class="card-img-top" alt="Producto 1">
            <div class="card-body">
              <h5>Galaxy-a05s</h5>
              <p class="text-muted text-decoration-line-through">$550.000</p>
              <p class="text-primary fw-bold">$420.000</p>
              <a href="#" class="btn btn-primary btn-sm">Comprar</a>
            </div>
          </div>
        </div>

      </div>
    </div>
    </div>


    <div>
      <p>diseño:  </p> <a href="https://www.canva.com/design/DAGcey64300/qIvq-KDkmEY8ug5nYEBF7A/edit">aqui</a>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>