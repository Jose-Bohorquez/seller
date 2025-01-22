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
            <a href="?c=Login&a=main" class="btn btn-session text-white me-2">Iniciar Sesión</a>
            <a href="?c=Registry" class="btn btn-register bg-white">Registrarse</a>
            <a href="#" class="text-white ms-3 fs-4"><i class="fa-solid fa-cart-shopping"></i></a>
          </div>
        </div>
      </div>
    </nav>
    <br>
    <!-- Carousel Section -->
    <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner" style="width: 1300px; height: 480px; margin: auto; overflow: hidden; border-radius: 8px;">
      <div class="carousel-item active">
          <a href="#">
            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
              <img src="assets/imagenes/landing/new/dog.png" class="rounded-3"
                style="max-width: 1300px; max-height: 480px; width: auto; height: auto;" alt="Promo 1">
            </div>
          </a>
        </div>  
        <div class="carousel-item">
          <a href="#">
            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
              <img src="assets/imagenes/landing/new/rc.png" class="rounded-3"
                style="max-width: 1300px; max-height: 480px; width: auto; height: auto;" alt="Promo 1">
            </div>
          </a>
        </div>
        <div class="carousel-item">
          <a href="#">
            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
              <img src="assets/imagenes/landing/new/mascotas.webp" class="rounded-3"
                style="max-width: 1300px; max-height: 480px; width: auto; height: auto;" alt="Promo 2">
            </div>
          </a>
        </div>
        <div class="carousel-item">
          <a href="#">
            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
              <img src="assets/imagenes/landing/new/s1-1.png" class="rounded-3"
                style="max-width: 1300px; max-height: 480px; width: auto; height: auto;" alt="Promo 3">
            </div>
          </a>
        </div>
        <div class="carousel-item">
          <a href="#">
            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
              <img src="assets/imagenes/landing/new/s1-2.png" class="rounded-3"
                style="max-width: 1300px; max-height: 480px; width: auto; height: auto;" alt="Promo 4">
            </div>
          </a>
        </div>
        <div class="carousel-item">
          <a href="#">
            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
              <img src="assets/imagenes/landing/new/rc.webp" class="rounded-3"
                style="max-width: 1300px; max-height: 480px; width: auto; height: auto;" alt="Promo 5">
            </div>
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
    <div class="container my-3 promo-section">
      <div class="row g-0">
        <div class="col-md-6">
          <a href="#">
            <img src="assets/imagenes/landing/new/s2-1.png" alt="Promo Left" class="w-100 h-100"
              style="border-radius: 8px 0 0 8px;">
          </a>
        </div>
        <div class="col-md-6">
          <div class="row g-0">
            <div class="col-12">
              <a href="#">
                <img src="assets/imagenes/landing/new/s2-2.png" alt="Promo Top Right" class="w-100 h-100"
                  style="border-radius: 0 8px 0 0 ;">
              </a>
            </div>
            <div class="col-6">
              <a href="#">
                <img src="assets/imagenes/landing/new/s2-3.png" alt="Promo Bottom Left" class="w-100 h-100"
                  style="border-radius: 0 0 0 0 ;">
              </a>
            </div>
            <div class="col-6">
              <a href="#">
                <img src="assets/imagenes/landing/new/s2-4.png" alt="Promo Bottom Right" class="w-100 h-100"
                  style="border-radius: 0 0 8px 0 ;">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container my-5 product-section">
      <div class="d-flex align-items-center mb-4">
        <h2 class="text-start mb-0 position-relative">
          Estrena Celular con Descuentos al Piso
          <span
            style="position: absolute; bottom: -5px; left: 0; height: 4px; width: 100%; background-color: red;"></span>
        </h2>
      </div>
      <br>
      <div class="row row-cols-2 row-cols-sm-3 row-cols-lg-6 g-3">
        <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
        <div class="col">
          <div class="card text-center position-relative">
            <!-- Listón de oferta -->
            <div class="position-absolute top-0 start-0 bg-danger text-white px-3 py-1 fw-bold"
              style="clip-path: polygon(0 0, 100% 0, 80% 100%, 0% 100%); font-size: 0.9em;">
              Oferta
            </div>
            <!-- Imagen del producto -->
            <img src="<?= $product->get_image(); ?>" class="card-img-top"
              alt="<?= htmlspecialchars($product->get_name()); ?>" style="height: 150px; object-fit: contain;">
            <!-- Información del producto -->
            <div class="card-body">
              <h5><?= htmlspecialchars($product->get_name()); ?></h5>
              <p class="text-muted text-decoration-line-through">$<?= number_format($product->get_price() * 1.2, 2); ?>
              </p>
              <p class="text-primary fw-bold">$<?= number_format($product->get_price(), 2); ?></p>
              <a href="#" class="btn btn-primary btn-sm">Comprar</a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <p class="text-center">No hay productos disponibles.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <br>
  <div class="container">
    <div class="row">
      <div class="col">
        <h6>DISEÑO: <a href="https://www.canva.com/design/DAGcey64300/qIvq-KDkmEY8ug5nYEBF7A/edit"><span>aqui</span></a>
        </h6>
      </div>
    </div>
  </div>
  <br>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>