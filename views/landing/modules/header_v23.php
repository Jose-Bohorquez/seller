<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
  <script src="assets/plantilla/bootstrap_5.3.3/assets/js/color-modes.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors modified: Jose bohorquez">
  <meta name="generator" content="Hugo 0.122.0">
  <title>Seller</title>
  <link rel="icon" href="assets/imagenes/landing/logo_servitel.ico" type="image/x-icon">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/footers/">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
  <link href="assets/plantilla/bootstrap_5.3.3/assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/b3a2e83ff1.js" crossorigin="anonymous"></script>
  <?php require_once("views/landing/modules/styles_gen.php"); ?>
</head>

<body>
  <?php require_once("views/landing/modules/btn_tem_up.php"); # botones de cambio de tema y subir al inicio ?>

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

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-body-white rounded-3">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <img class="mx-5" id="logo-servitel" src="assets/imagenes/landing/logo_servitel.png" alt="Logo"
          style="width: 100px; height: auto; margin-right: 10px;">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link active" href="#">Inicio</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">Categorías</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Celulares</a></li>
              <li><a class="dropdown-item" href="#">Computadores</a></li>
              <li><a class="dropdown-item" href="#">Equipos Usados</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Métodos de Pago</a></li>
              <li><a class="dropdown-item" href="#">Reglas de Promos</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link active" href="#">Contacto</a></li>
        </ul>
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active btn-bd-primary-v2 border text-white rounded-3"
              href="<?= isset($_SESSION['sesion_status']) && $_SESSION['sesion_status'] === 'ok' ? '?c=MenuA&a=log_out' : '?c=Login&a=main' ?>">
              <?= isset($_SESSION['sesion_status']) && $_SESSION['sesion_status'] === 'ok' ? 'Cerrar sesión' : 'Registrarse / Iniciar Sesion' ?>
            </a>
          </li>
        </ul>

        <!-- Carrito con ícono -->
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <!-- Icono del carrito -->
          <li class="nav-item d-flex align-items-center">
            <i class="fa-solid fa-cart-shopping fs-3 text-primary" data-bs-toggle="modal"
              data-bs-target="#modalCarrito"></i>
            <div id="total-carrito" class="ms-2 fs-5">$0.00</div>
          </li>

        </ul>
      </div>
    </div>
  </nav>


  <!-- Modal del carrito -->
<div class="modal fade" id="modalCarrito" tabindex="-1" aria-labelledby="modalCarritoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg"> <!-- Cambiado a modal-lg para mayor espacio -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCarritoLabel">Tu Carrito</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Tabla envuelta en un contenedor con scroll -->
        <div class="table-responsive">
          <table class="table table-striped align-middle">
            <thead>
              <tr>
                <th scope="col">Imagen</th>
                <th scope="col">Producto</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio</th>
                <th scope="col">Total</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody id="contenido-carrito">
              <!-- Aquí se agregarán dinámicamente los productos -->
            </tbody>
          </table>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
          <h5>Total:</h5>
          <p id="total-carrito-modal">$0.00</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-warning" id="vaciar-carrito">Vaciar carrito</button>
      </div>
    </div>
  </div>
</div>






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
  <div class="container col-xxl-8 ">
    <div class="row flex-lg-row-reverse align-items-center g-5">
      <div class="col-10 col-sm-8 col-lg-6 py-5">

        <div id="drag-container">
          <div id="spin-container">
            <?php
        // Mostrar las imágenes aleatorias (hasta 6)
        foreach ($random_images as $image_url) {
            echo '<img src="' . $image_url . '" alt="Imagen del Producto">';
        }
        ?>
          </div>
          <div id="ground"></div>
        </div>



      </div>
      <div class="col-lg-6">
        <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-1">Llego la navidad</h1>
        <p class="lead">¡ Y papa noel trajo las mejores ofertas para esta navidad!</p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
          <button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Ver</button>
        </div>
      </div>
    </div>
  </div>
  <div class="container ">
    <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%"
      data-bs-smooth-scroll="true" class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="0">
      <h4 id="scrollspyHeading1"></h4>
      <br>
      <h1 class="text-center">Celulares</h1>
      <br>





<section>
    <br>
    <h4 id="scrollspyHeading3">Productos</h4>
    <div class="container">
        <div class="row g-4 justify-content-center">
            <?php
            $all_products = array_merge($category1_products ?? [], $category2_products ?? [], $category3_products ?? []);
            $product_index = 0; // Contador para manejar la visibilidad de los productos

            if (!empty($all_products)) {
                foreach ($all_products as $producto) {
                    $product_index++;
                    echo '
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 product-card" style="display: ' . ($product_index <= 4 ? 'block' : 'none') . '; ">
                        <div class="card h-100 shadow-sm">
                            <div class="card-img-top d-flex justify-content-center align-items-center p-3" style="height: 200px; background-color: #f8f9fa; border-bottom: 1px solid #ddd;">
                                <img src="' . $producto->get_image() . '" alt="Producto" class="img-fluid" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-center">' . $producto->get_name() . '</h5>
                                <p class="card-text text-center fw-bold text-primary fs-5 mb-2">$' . $producto->get_price() . '</p>
                                <p class="card-text text-center text-muted">Disponible: ' . $producto->get_amount() . ' unidades</p>
                                <div class="accordion" id="accordion' . $producto->get_id() . '">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading' . $producto->get_id() . '">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $producto->get_id() . '" aria-expanded="false" aria-controls="collapse' . $producto->get_id() . '">
                                                Descripción Técnica
                                            </button>
                                        </h2>
                                        <div id="collapse' . $producto->get_id() . '" class="accordion-collapse collapse" aria-labelledby="heading' . $producto->get_id() . '">
                                            <div class="accordion-body">
                                                ' . $producto->get_description() . '
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-auto mt-2">
                                    <button class="btn btn-primary w-100 agregar-al-carrito" data-id="' . $producto->get_id() . '">Agregar al carrito</button>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo '<p class="text-center">No hay productos disponibles en esta categoría.</p>';
            }
            ?>
        </div>
        <?php if (count($all_products) > 4): ?>
            <div class="text-center mt-4">
                <button id="loadMore" class="btn btn-secondary">Ver más</button>
            </div>
        <?php endif; ?>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const loadMoreButton = document.getElementById("loadMore");
        const productCards = document.querySelectorAll(".product-card");
        let visibleCards = 4;

        if (loadMoreButton) {
            loadMoreButton.addEventListener("click", function() {
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







      <br>
      <h4 id="scrollspyHeading2"></h4>
      <br>
      <h1 class="text-center">Computadores</h1>
      <br>

      <section>
        <br>
        <h4 id="scrollspyHeading3"></h4>
        <section>
          <div class="container">
            <div class="row g-5 justify-content-center">
              <?php
        if (isset($category2_products) && !empty($category2_products)) {
            $product_count = count($category2_products); // Contamos los productos para saber cuántos hay

            // Determinamos cuántas columnas debe tener la fila
            foreach ($category2_products as $producto) {
                echo '
                <div class="col-12 col-sm-6 col-md-' . (12 / min($product_count, 4)) . '"> <!-- Ajusta el tamaño de columna basado en la cantidad -->
                  <div class="card h-100" style="max-width: 250px; margin: 0 auto;">
                    <img src="' . $producto->get_image() . '" class="card-img-top img-fluid rounded-5" alt="..."
                         style="max-height: 200px; width: 200px; object-fit: contain; margin: 0 auto; border-radius: 15px;">
                    <div class="card-body" style="padding: 0.75rem;">
                      <h5 class="card-title text-center" style="font-size: 1rem;">' . $producto->get_name() . '</h5>
                      <p class="card-text text-center" style="font-size: 0.875rem;">' . $producto->get_description() . '</p>
                      <p class="card-text text-center" style="font-size: 1rem; font-weight: bold;">$' . $producto->get_price() . '</p>
                      <p class="card-text text-center" style="font-size: 0.875rem;">Disponible: ' . $producto->get_amount() . ' unidades</p>
                      <div class="d-grid gap-2">
<button class="btn btn-primary w-100 agregar-al-carrito" data-id="' . $producto->get_id() . '">Agregar al carrito</button>                      </div>
                    </div>
                  </div>
                </div>';
            }
        } else {
            echo '<p>No hay productos disponibles en esta categoría.</p>';
        }
        ?>
            </div>
          </div>
        </section>
      </section>


      <br>
      <h4 id="scrollspyHeading3"></h4>
      <br>
      <h1 class="text-center">Equipos Usados</h1>
      <br>
      <section>
        <div class="container">
          <div class="row g-5 justify-content-center">
            <?php
        if (isset($category3_products) && !empty($category3_products)) {
            $product_count = count($category3_products); // Contamos los productos para saber cuántos hay

            // Determinamos cuántas columnas debe tener la fila
            foreach ($category3_products as $producto) {
                echo '
                <div class="col-12 col-sm-6 col-md-' . (12 / min($product_count, 4)) . '"> <!-- Ajusta el tamaño de columna basado en la cantidad -->
                  <div class="card h-100" style="max-width: 250px; margin: 0 auto;">
                    <img src="' . $producto->get_image() . '" class="card-img-top img-fluid rounded-5" alt="..."
                         style="max-height: 200px; width: 200px; object-fit: contain; margin: 0 auto; border-radius: 15px;">
                    <div class="card-body" style="padding: 0.75rem;">
                      <h5 class="card-title text-center" style="font-size: 1rem;">' . $producto->get_name() . '</h5>
                      <p class="card-text text-center" style="font-size: 0.875rem;">' . $producto->get_description() . '</p>
                      <p class="card-text text-center" style="font-size: 1rem; font-weight: bold;">$' . $producto->get_price() . '</p>
                      <p class="card-text text-center" style="font-size: 0.875rem;">Disponible: ' . $producto->get_amount() . ' unidades</p>
                      <div class="d-grid gap-2">
                        <button class="btn btn-primary w-100 agregar-al-carrito" data-id="' . $producto->get_id() . '">Agregar al carrito</button>
                      </div>
                    </div>
                  </div>
                </div>';
            }
        } else {
            echo '<p>No hay productos disponibles en esta categoría.</p>';
        }
        ?>
          </div>
        </div>
      </section>
      </section>



      <br>
      <h4 id="scrollspyHeading4"></h4>
      <br>
      <h1 class="text-center">Contacto</h1>
      <section>
        <div class="container my-5">
          <div class="card shadow-sm rounded-5">
            <div class="card-body px-4 py-5">
              <h4 class="text-center mb-4">Formulario de Contacto</h4>
              <div class="row gy-3">
                <div class="col-12 col-md-6">
                  <label for="name" class="form-label">Nombres y Apellidos:</label>
                  <input class="form-control" type="text" id="name" name="name"
                    placeholder="Ingrese su nombre completo">
                </div>
                <div class="col-12 col-md-6">
                  <label for="phone" class="form-label">Teléfono:</label>
                  <input class="form-control" type="text" id="phone" name="phone" placeholder="Ingrese su teléfono">
                </div>
                <div class="col-12 col-md-6">
                  <label for="email" class="form-label">Correo:</label>
                  <input class="form-control" type="email" id="email" name="email"
                    placeholder="Ingrese su correo electrónico">
                </div>
                <div class="col-12 col-md-6">
                  <label for="subject" class="form-label">Asunto:</label>
                  <input class="form-control" type="text" id="subject" name="subject" placeholder="Ingrese el asunto">
                </div>
                <div class="col-12">
                  <label for="message" class="form-label">Contenido del Correo:</label>
                  <textarea class="form-control form-control-lg" id="message" name="message" rows="4"
                    placeholder="Escribe tu mensaje aquí" required></textarea>
                </div>
                <div class="col-12">
                  <label class="form-label">¿Cómo prefieres recibir nuestra respuesta?</label>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="response" id="responseWhatsapp"
                      value="whatsapp">
                    <label class="form-check-label" for="responseWhatsapp">WhatsApp</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="response" id="responseEmail" value="email">
                    <label class="form-check-label" for="responseEmail">Correo Electrónico</label>
                  </div>
                </div>
                <div class="col-12 text-center mt-4">
                  <button class="btn btn-primary btn-lg">Enviar Solicitud de Contacto</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <br>
      <h4 id="scrollspyHeading5"></h4>
      <section>
        <div class="container my-5">
          <h2 class="text-center mb-4">Métodos de Pago</h2>
          <p class="text-center text-muted">Selecciona el método de pago que prefieras. Cada opción incluye
            instrucciones detalladas para facilitar el proceso.</p>
          <div class="row gy-3">
            <div class="col-12 col-md-3">
              <div class="card shadow-sm rounded-5">
                <div class="card-body text-center">
                  <i class="fa-solid fa-money-check-dollar fa-3x text-warning"></i>
                  <h5 class="mt-3">Consignación Efecty</h5>
                  <p class="text-muted">Realiza tu pago en cualquier punto Efecty presentando el número de referencia.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-3">
              <div class="card shadow-sm rounded-5">
                <div class="card-body text-center">
                  <i class="fa-solid fa-money-bill-transfer fa-3x text-primary"></i>
                  <h5 class="mt-3">Transferencia</h5>
                  <p class="text-muted">Haz tu transferencia desde tu cuenta bancaria a nuestra cuenta registrada.</p>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-3">
              <div class="card shadow-sm rounded-5">
                <div class="card-body text-center">
                  <i class="fa-solid fa-sack-dollar fa-3x text-success"></i>
                  <h5 class="mt-3">Efectivo</h5>
                  <p class="text-muted">Puedes pagar en efectivo en nuestras oficinas o al representante autorizado.</p>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-3">
              <div class="card shadow-sm rounded-5">
                <div class="card-body text-center">
                  <i class="fa-solid fa-landmark fa-3x text-info"></i>
                  <h5 class="mt-3">Por la Cooperativa</h5>
                  <p class="text-muted">Usa los servicios de la cooperativa para realizar tus pagos de forma segura.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <br>
      <h4 id="scrollspyHeading6"></h4>
      <br>
      <section class="container-fluid">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <!-- Hero Section -->
              <div class="p-4 rounded-3 bg-body shadow-sm ">
                <h1 class="text-center mb-4">Importante</h1>
                <!-- Fechas -->
                <div class="mb-4">
                  <h4 class="fw-bold">Fechas:</h4>
                  <p>Las ofertas estarán disponibles desde el <strong>17 de diciembre</strong> hasta el <strong>26 de
                      diciembre</strong>.</p>
                  <p>Por medio de la cooperativa tienes hasta el <strong>23 de diciembre</strong> para hacer la
                    solicitud.</p>
                </div>
                <br>
                <!-- Descuentos exclusivos -->
                <div class="mb-4">
                  <h4 class="fw-bold">Descuentos exclusivos:</h4>
                  <p>Los descuentos aplican solo para productos seleccionados durante el evento. Verifica la lista de
                    productos en oferta en nuestro <a href="#" class="link-primary">sitio web</a>.</p>
                </div>
                <br>
                <!-- Métodos de pago y tiempos de entrega -->
                <div class="mb-4">
                  <h4 class="fw-bold">Métodos de pago y tiempos de entrega:</h4>
                  <p><strong>Transferencia, Efecty o Pago en Efectivo:</strong> La entrega de tu equipo será a partir
                    de 2 a 3 días hábiles máximo.</p>
                  <p><strong>Pago por Cooperativa:</strong> La entrega será entre 3 a 4 días hábiles máximo.</p>
                </div>
                <br>
                <!-- Stock limitado -->
                <div class="mb-4">
                  <h4 class="fw-bold">Stock limitado:</h4>
                  <p>Las ofertas están sujetas a la disponibilidad de inventario. ¡Apresúrate, que se agotan rápido!
                  </p>
                  <p>En el correo especifica en la sede de Servitel que te encuentras.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <br>
    </div>
  </div>
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
  <script src="assets/plantilla/bootstrap_5.3.3/assets/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/carrusel.js"></script>
  <script src="assets/js/carrito.js"></script>
</body>

</html>