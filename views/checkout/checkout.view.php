<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout - MY E-COMMERCE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7380e2e883.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Navbar -->
    <?php #include 'navbar.php'; ?>

    <div class="container">
        <main>
            <div class="py-5 text-center">
                <h2>Proceso de Compra</h2>
                <p class="lead">Revisa tu carrito y completa la información necesaria para finalizar la compra.</p>
            </div>

            <div class="row g-5">
                <!-- Resumen del carrito -->
<div class="col-md-5 col-lg-4 order-md-last">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-primary">Tu carrito</span>
        <span class="badge bg-primary rounded-pill" id="cart-count">0</span>
    </h4>
    <ul class="list-group mb-3" id="cart-items">
        <!-- Los productos se cargarán dinámicamente -->
    </ul>

    <!-- Total -->
    <li class="list-group-item d-flex justify-content-between">
        <span>Total</span>
        <strong id="cart-total">$0.00</strong>
    </li>

    <!-- Aplicar código promocional -->
    <form class="card p-2">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Código promocional">
            <button type="button" class="btn btn-secondary">Aplicar</button>
        </div>
    </form>
</div>


                <!-- Formulario de facturación -->
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Datos de Facturación</h4>
                    <form action="index.php?c=Order&a=confirm" method="POST" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="firstName" name="nombre" value="<?= $usuario['nombre'] ?? ''; ?>" required>
                                <div class="invalid-feedback">Tu nombre es obligatorio.</div>
                            </div>

                            <div class="col-sm-6">
                                <label for="lastName" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="lastName" name="apellido" value="<?= $usuario['apellido'] ?? ''; ?>" required>
                                <div class="invalid-feedback">Tu apellido es obligatorio.</div>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="correo" value="<?= $usuario['correo'] ?? ''; ?>" required>
                                <div class="invalid-feedback">Ingresa un correo válido.</div>
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="address" name="direccion" placeholder="1234 Calle Principal" required>
                                <div class="invalid-feedback">Ingresa tu dirección de envío.</div>
                            </div>
                        </div>

                        <hr class="my-4">
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Finalizar Compra</button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <?php #include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
