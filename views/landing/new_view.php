<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MY E-COMMERCE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/7380e2e883.js" crossorigin="anonymous"></script>
  <link rel="icon" href="/ruta/a/tu/favicon.png" type="image/png">
  <style>
    /* Navbar */
    .navbar {
      background: linear-gradient(to right, #007bff, #00aaff);
    }

    .navbar .input-group {
      margin: auto;
      width: 40%;
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
            <!-- Icono del carrito -->
            <li class="nav-item d-flex align-items-center">
              <i class="fa-solid fa-cart-shopping fs-3 text-light" data-bs-toggle="modal"
                data-bs-target="#modalCarrito"></i>
              <div id="total-carrito" class="ms-2 fs-5">$0.00</div>
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
          <ul class="navbar-nav ms-auto px-3 mx-2">
            <!-- Icono del carrito -->
            <li class="nav-item d-flex align-items-center">
              <i class="fa-solid fa-cart-shopping fs-3 text-white" data-bs-toggle="modal"
                data-bs-target="#modalCarrito"></i>
              <div id="total-carrito" class="ms-2 fs-5">$0.00</div>
            </li>
          </ul>
          <?php
}
?>




        </div>
      </div>
    </nav>





    <!-- Modal del carrito -->
<!-- Modal del carrito -->
<div class="modal fade" id="modalCarrito" tabindex="-1" aria-labelledby="modalCarritoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCarritoLabel">Tu Carrito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="contenido-carrito">
                            <!-- Productos cargados dinámicamente -->
                        </tbody>
                    </table>
                </div>
                <div class="text-end">
                    <h5>Total: $<span id="total-carrito">0.00</span></h5>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-danger" id="vaciar-carrito">Vaciar carrito</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const modalCarrito = document.querySelector("#modalCarrito");

    modalCarrito.addEventListener("show.bs.modal", function () {
        fetch("?c=CartController&a=showCart")
            .then(response => response.json())
            .then(data => {
                const tbody = document.querySelector("#contenido-carrito");
                const totalCarrito = document.querySelector("#total-carrito");
                tbody.innerHTML = "";
                let total = 0;

                if (data.carrito) {
                    for (let producto of Object.values(data.carrito)) {
                        total += producto.subtotal;
                        tbody.innerHTML += `
                            <tr>
                                <td>${producto.nombre}</td>
                                <td>${producto.cantidad}</td>
                                <td>$${producto.precio.toFixed(2)}</td>
                                <td>$${producto.subtotal.toFixed(2)}</td>
                            </tr>
                        `;
                    }
                }
                totalCarrito.textContent = total.toFixed(2);
            });
    });

    document.querySelector("#vaciar-carrito").addEventListener("click", function () {
        fetch("?c=CartController&a=clearCart", { method: "POST" })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.querySelector("#contenido-carrito").innerHTML = "";
                    document.querySelector("#total-carrito").textContent = "0.00";
                }
            });
    });
});
</script>








    <?php
#session_start();
//agregar al carrito

if (isset($_POST['id'])) {
    $productId = $_POST['id'];

    // Conectar a la base de datos y obtener la información del producto
    // Asegúrate de tener una clase de productos para obtener los datos (como Product::get_product_by_id($productId))
    $producto = new Product();
    $productoInfo = $producto->get_product_by_id($productId);

    // Verifica si ya existe el carrito
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Verifica si el producto ya está en el carrito
    if (isset($_SESSION['carrito'][$productId])) {
        // Si el producto ya está en el carrito, aumentamos la cantidad
        $_SESSION['carrito'][$productId]['cantidad']++;
    } else {
        // Si no está en el carrito, lo agregamos
        $_SESSION['carrito'][$productId] = [
            'id' => $productoInfo->get_id(),
            'nombre' => $productoInfo->get_name(),
            'precio' => $productoInfo->get_price(),
            'cantidad' => 1,
            'imagen' => $productoInfo->get_image(),
        ];
    }

    echo "Producto agregado al carrito!";
}
?>



    <br>

    <!-- Carousel Section -->
    <div id="carouselExampleAutoplaying" class="carousel slide d-flex justify-content-center" data-bs-ride="carousel">
      <div class="carousel-inner text-center">
        <div class="carousel-item active" data-bs-interval="40000">
          <img src="assets/imagenes/landing/new/baner_botas.png" class="d-block w-100 rounded-3" alt="Imagen 1">
        </div>
        <div class="carousel-item" data-bs-interval="40000">
          <img src="assets/imagenes/landing/new/baner_rc.png" class="d-block w-100 rounded-3" alt="Imagen 2">
        </div>
        <!-- <div class="carousel-item" data-bs-interval="40000">
          <img src="assets/imagenes/landing/new/mascotas.webp" class="d-block w-100 rounded-3" alt="Imagen 3">
        </div>
        <div class="carousel-item" data-bs-interval="40000">
          <img src="assets/imagenes/landing/new/rc.webp" class="d-block w-100 rounded-3" alt="Imagen 3">
        </div>
        <div class="carousel-item" data-bs-interval="40000">
          <img src="assets/imagenes/landing/new/s1-1.png" class="d-block w-100 rounded-3" alt="Imagen 3">
        </div>
        <div class="carousel-item" data-bs-interval="40000">
          <img src="assets/imagenes/landing/new/s1-2.png" class="d-block w-100 rounded-3" alt="Imagen 3">
        </div> -->
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
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
              <!-- <a href="#" class="btn btn-primary btn-sm">Comprar</a> -->
               
              <button class="btn btn-primary w-100 agregar-al-carrito" data-id="<?= $product->get_id(); ?>">añadir al carrito</button>

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

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const loadMoreButton = document.getElementById("loadMore");
      const productCards = document.querySelectorAll(".product-card");
      let visibleCards = 4;

      if (loadMoreButton) {
        loadMoreButton.addEventListener("click", function () {
          const totalCards = productCards.length;
          const nextVisibleCards = visibleCards + 4;

          for (let i = visibleCards; i < nextVisibleCards && i < totalCards; i++) {
            productCards[i].style.display = "block";
          }

          visibleCards = nextVisibleCards;

          // Ocultar el botón si se muestran todos los productos
          if (visibleCards >= totalCards) {
            loadMoreButton.style.display = "none";
          }
        });
      }
    });
  </script>



  <div class="container ">
    <footer class="py-5">
      <div class="row text-center text-md-start">
        <div class="col-12 col-md-3 mb-3">
          <h5>Atención al cliente</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Política de devolución y
                reembolso</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Política de propiedad
                intelectual</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Política de envíos</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Reportar actividad
                sospechosa</a></li>
          </ul>
        </div>
        <div class="col-12 col-md-3 mb-3">
          <h5>Ayuda</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Centro de ayuda y preguntas
                frecuentes</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Centro de seguridad</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Protección de compras de
                seller</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Asóciate a seller</a></li>
          </ul>
        </div>
        <div class="col-12 col-md-6 mb-3">
          <form>
            <h5>Suscríbete a nuestro boletín</h5>
            <p>Resumen mensual de lo nuevo y emocionante de nuestra parte.</p>
            <div class="d-flex flex-column flex-sm-row w-100 gap-2 justify-content-center">
              <label for="newsletter1" class="visually-hidden">Dirección de correo electrónico</label>
              <input id="newsletter1" type="text" class="form-control" placeholder="Dirección de correo electrónico">
              <button class="btn btn-primary" type="button">Suscribirse</button>
            </div>
          </form>
        </div>
      </div>
      <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top align-items-center">
        <p class="mb-0 text-center">&copy; 2025 Servitelecomunicaciones SAS. Todos los derechos reservados.</p>
        <ul class="list-unstyled d-flex justify-content-center mb-0">
          <li class="ms-3"><a class="link-body-emphasis" href="#"><svg class="bi" width="48" height="48">
                <use xlink:href="#twitter" /></svg></a></li>
          <li class="ms-3"><a class="link-body-emphasis" href="#"><svg class="bi" width="48" height="48">
                <use xlink:href="#instagram" /></svg></a></li>
          <li class="ms-3"><a class="link-body-emphasis" href="#"><svg class="bi" width="48" height="48">
                <use xlink:href="#facebook" /></svg></a></li>
        </ul>
      </div>
    </footer>
  </div>
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

  <!-- Incluye la librería de SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    // Función para obtener parámetros de la URL
    function getQueryParam(param) {
      const urlParams = new URLSearchParams(window.location.search);
      return urlParams.get(param);
    }

    // Detectar si 'm=loginOk' está presente en la URL
    if (getQueryParam('m') === 'loginOk') {
      // Mostrar SweetAlert2
      Swal.fire({
        title: '¡Ingreso Éxitoso!',
        text: 'ya puedes comprar.',
        icon: 'success',
        timer: 3000, // 3 segundos
        timerProgressBar: true,
        showCloseButton: true, // Habilitar botón de cerrar (X)
        showConfirmButton: false, // Ocultar botón de confirmación
        closeButtonHtml: '&times;', // Personalizar el botón de cerrar
      });
    }
  </script>

  <script src="assets/js/carrito.js"></script>

</body>

</html>