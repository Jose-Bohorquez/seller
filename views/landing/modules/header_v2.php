<?php
// Iniciar la sesión
session_start();

// Comprobar el estado de la sesión
function verificarSesionActiva() {
    if (isset($_SESSION['sesion_status']) && $_SESSION['sesion_status'] === 'ok') {
        echo "<p>Bienvenido, {$_SESSION['name']} {$_SESSION['lastname']}</p>";
        echo "<p>Correo: {$_SESSION['email']}</p>";
        echo "<p>Rol: {$_SESSION['rol']}</p>";
    } else {
        echo "<p>No estás logueado. Por favor, <a href='?c=Login&a=main'>inicia sesión</a></p>";
    }
}

// Obtener el total del carrito
function obtenerTotalCarrito() {
    $total = 0;
    if (!empty($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }
    }
    return number_format($total, 2, '.', '');
}

// Obtener productos del carrito
function obtenerProductosCarrito() {
    return $_SESSION['carrito'] ?? [];
}
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="assets/plantilla/bootstrap_5.3.3/assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Seller</title>
    <link rel="icon" href="assets/imagenes/landing/logo_servitel.ico" type="image/x-icon">
    <link href="assets/plantilla/bootstrap_5.3.3/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b3a2e83ff1.js" crossorigin="anonymous"></script>
    <?php require_once("views/landing/modules/styles_gen.php"); ?>
</head>

<body>
    <?php require_once("views/landing/modules/btn_tem_up.php"); ?>

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
                            <li><hr class="dropdown-divider"></li>
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
                            <?= isset($_SESSION['sesion_status']) && $_SESSION['sesion_status'] === 'ok' ? 'Cerrar sesión' : 'Registrarse / Iniciar Sesión' ?>
                        </a>
                    </li>
                </ul>

                <!-- Carrito con ícono -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item d-flex align-items-center">
                        <i class="fa-solid fa-cart-shopping fs-3 text-primary" data-bs-toggle="modal" data-bs-target="#modalCarrito"></i>
                        <div id="total-carrito" class="ms-2 fs-5">$<?= obtenerTotalCarrito(); ?></div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Modal del carrito -->
    <div class="modal fade" id="modalCarrito" tabindex="-1" aria-labelledby="modalCarritoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCarritoLabel">Tu Carrito</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="contenido-carrito">
    <?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0): ?>
        <?php foreach ($_SESSION['carrito'] as $id => $producto): ?>
            <tr>
                <td><img src="<?= $producto['imagen'] ?>" alt="<?= $producto['nombre'] ?>" style="width: 50px;"></td>
                <td><?= $producto['nombre'] ?></td>
                <td><?= $producto['cantidad'] ?></td>
                <td>$<?= $producto['precio'] ?></td>
                <td>$<?= number_format($producto['precio'] * $producto['cantidad'], 2) ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5" class="text-center">El carrito está vacío.</td>
        </tr>
    <?php endif; ?>
</tbody>

                    </table>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h5>Total:</h5>
                        <p id="total-carrito-modal">$<?= obtenerTotalCarrito(); ?></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="vaciarCarrito()">Vaciar carrito</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de Categorías -->
    <div class="container my-5">
        <h1 class="text-center mb-4">Nuestros Productos</h1>

        <!-- Categoría 1: Celulares -->
        <h2 class="text-center mb-3">Celulares</h2>
        <div class="row mb-5">
            <?php foreach ($category1_products as $producto) : ?>
                <div class="col-md-4">
                    <div class="card h-100">
                        <img class="card-img-top" src="<?= $producto->get_image() ?>" alt="Celular">
                        <div class="card-body">
                            <h5 class="card-title text-center"><?= $producto->get_name() ?></h5>
                            <p class="card-text text-center"><?= $producto->get_description() ?></p>
                            <p class="card-text text-center fw-bold">$<?= $producto->get_price() ?></p>
                            <div class="d-grid">
                                <button class="btn btn-primary agregar-al-carrito" data-id="<?= $producto->get_id() ?>">Agregar al carrito</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Categoría 2: Computadores -->
        <h2 class="text-center mb-3">Computadores</h2>
        <div class="row mb-5">
            <?php foreach ($category2_products as $producto) : ?>
                <div class="col-md-4">
                    <div class="card h-100">
                        <img class="card-img-top" src="<?= $producto->get_image() ?>" alt="Computador">
                        <div class="card-body">
                            <h5 class="card-title text-center"><?= $producto->get_name() ?></h5>
                            <p class="card-text text-center"><?= $producto->get_description() ?></p>
                            <p class="card-text text-center fw-bold">$<?= $producto->get_price() ?></p>
                            <div class="d-grid">
                                <button class="btn btn-primary agregar-al-carrito" data-id="<?= $producto->get_id() ?>">Agregar al carrito</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Categoría 3: Equipos Usados -->
        <h2 class="text-center mb-3">Equipos Usados</h2>
        <div class="row mb-5">
            <?php foreach ($category3_products as $producto) : ?>
                <div class="col-md-4">
                    <div class="card h-100">
                        <img class="card-img-top" src="<?= $producto->get_image() ?>" alt="Equipo Usado">
                        <div class="card-body">
                            <h5 class="card-title text-center"><?= $producto->get_name() ?></h5>
                            <p class="card-text text-center"><?= $producto->get_description() ?></p>
                            <p class="card-text text-center fw-bold">$<?= $producto->get_price() ?></p>
                            <div class="d-grid">
                                <button class="btn btn-primary agregar-al-carrito" data-id="<?= $producto->get_id() ?>">Agregar al carrito</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        // Agregar producto al carrito
        function agregarAlCarrito(productId) {
            fetch('?c=CarritoController&a=agregarAlCarrito', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id=${productId}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.total && data.productos) {
                    actualizarTotalCarrito(data.total);
                    actualizarProductosCarrito(data.productos);
                } else {
                    alert('Error al agregar el producto al carrito');
                }
            })
            .catch(error => console.error('Error:', error));
        }

        // Actualizar total del carrito
        function actualizarTotalCarrito(total) {
            document.getElementById('total-carrito').textContent = `$${total}`;
            document.getElementById('total-carrito-modal').textContent = `$${total}`;
        }

        // Actualizar productos en el carrito (modal)
        function actualizarProductosCarrito(productos) {
            const tablaCarrito = document.getElementById('contenido-carrito');
            tablaCarrito.innerHTML = '';

            if (productos.length > 0) {
                productos.forEach(producto => {
                    tablaCarrito.innerHTML += `
                        <tr>
                            <td><img src="${producto.imagen}" alt="${producto.nombre}" style="width: 50px;"></td>
                            <td>${producto.nombre}</td>
                            <td>${producto.cantidad}</td>
                            <td>$${producto.precio}</td>
                            <td>$${(producto.precio * producto.cantidad).toFixed(2)}</td>
                        </tr>`;
                });
            } else {
                tablaCarrito.innerHTML = '<tr><td colspan="5">Tu carrito está vacío</td></tr>';
            }
        }

        // Vaciar el carrito
        function vaciarCarrito() {
            fetch('?c=CarritoController&a=vaciarCarrito', { method: 'POST' })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    actualizarTotalCarrito(0);
                    actualizarProductosCarrito([]);
                }
            });
        }
    </script>

    <script src="assets/plantilla/bootstrap_5.3.3/assets/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
